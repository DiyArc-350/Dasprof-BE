<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $category_code
 * @property string $category_name
 * @property string|null $category_desc
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Photo[] $photos
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'category';

	protected $fillable = [
		'category_code',
		'category_name',
		'category_desc'
	];

	public function photos()
	{
		return $this->hasMany(Photo::class, 'id_category');
	}
	
}
