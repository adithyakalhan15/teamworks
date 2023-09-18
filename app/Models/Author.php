<?php 

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Publication;
use Illuminate\Support\Str;

class Author extends Model
{
   protected $connection = 'mongodb';
   //protected $collection = 'authors';

   /**
    * Schema
      _id: objectId,
      first_name: String,
      middle_name: String,
      last_name: String,
    */


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
		if (empty($this->first_name)){
			throw new Exception("name is required\n", 1);
		}
        if (empty($this->last_name)){
			throw new Exception("name is required\n", 1);
		}
        return true;
    }

    public function GetNameWithInitials(){
        //format Surname FM. (e.g. Senevirathne SM.)
        $name = $this->last_name . " " . $this->first_name[0];
        if (!empty($this->middle_name)){
            $name = $name . $this->middle_name[0];
        }
        return $name . ".";
    }

    public function GetFullName(){
        return $this->first_name . " " . $this->middle_name . " " . $this->last_name;
    }

    //relationships
	/*public function publications(){
		return $this->hasMany(Publication::class, 'author_id', '_id');
	}*/
}