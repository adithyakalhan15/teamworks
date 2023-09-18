<?php 

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\User;
use App\Models\Author;
use Illuminate\Support\Str;
use MongoDB\BSON\ObjectId;

class Publication extends Model
{
   protected $connection = 'mongodb';
   //protected $collection = 'documents';

   const VISIBILITY_PRIVATE = 0;
   const VISIBILITY_PUBLIC = 1;
   const VISIBILITY_DRAFT = 2;

   const TYPE_ARTICLE = 0;
   /**
    * Schema
      title: String,
	  slug: String,
      owner_id: int,
      author_id: [int],
      type: int, // 0: article

      content: FullText,
      resources: [Resource],
      download_resources: [Resource],

      uploaded_at: Date,
      approved_at: Date,
      is_approved: Boolean,
      visibility: int // 0: private, 1: public 2: draft

    * Other properties that might use in future
      doi: String,
      isbn: String,
      volume: String,
      pages: String,
      year: int,
    */

	public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Set default values
        $this->attributes['author_id'] = [];
        $this->attributes['resources'] = [];
        $this->attributes['download_resources'] = [];
        $this->attributes['is_approved'] = false;
        $this->attributes['visibility'] = 0;
        $this->attributes['slug'] = "";
    }


    // Override the save method for value checks
    public function save(array $options = [])
    {
        // Perform value checks before saving
        $this->validateProperties();
        return parent::save($options); // Call the original save method
    }

    // Validate the model's data
    /**
     * @throws \Exception
     */
    protected function validateProperties()
    {
        // Check if the title is empty
		if (empty($this->title)){
			throw new Exception("title is required", 1);
		}

		//owner id check, it should precenst and exists in the database
		if (empty($this->owner_id)){
			throw new Exception("owner_id is required", 1);
		}else if (!User::where("_id", $this->owner_id)->exists()){
			throw new Exception("owner_id is invalid", 1);
		}

		//auther_id check. it should be an array or null
		if (!is_null($this->author_id) && !is_array($this->author_id)){
			throw new Exception("author_id should be null or an array", 1);
		}

		//auto generate slug if it is empty
		if (empty($this->slug)){
			$this->slug = Str::slug($this->title);
			//check whether it is already exists
			$slug_count = Publication::where("slug", $this->slug)->count();
			if ($slug_count > 0){
				$this->slug = $this->slug . "-" . $slug_count;
			}
		}
        return true;
    }

	//relationships
	public function owner(){
		return $this->belongsTo(User::class, 'owner_id', '_id');
	}

	public function authors(){
		return $this->belongsToMany(Author::class, 'authors', '_id', 'author_id');
	}

    public function GetAuthors(){
        //print_r($this->author_id);
        $x = [];
        for ($i=0; $i < count($this->author_id); $i++) { 
            $x[] = new ObjectId($this->author_id[$i]);
        }
        return Author::whereRaw(['_id' => ['$in' => $x]])->get();
	}
}