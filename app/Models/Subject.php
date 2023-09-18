<?php 

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Models\Publication;
use Illuminate\Support\Str;

class Subject extends Model
{
   protected $connection = 'mongodb';
   //protected $collection = 'documents';

   /**
    * Schema
      _id: objectId,
      name: String,
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
		if (empty($this->name)){
			throw new Exception("name is required\n", 1);
		}
        return true;
    }
    /*
	//relationships
	public function publications(){
		return $this->hasMany(Publication::class, 'owner_id', '_id');
	}*/
}