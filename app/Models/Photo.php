<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 * 
 * @property int $id
 * @property int $id_category
 * @property int $photo_order
 * @property string $photo_render
 * @property string $photo_alt
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Category $category
 *
 * @package App\Models
 */
class Photo extends Model
{
	protected $table = 'photo';

	protected $casts = [
		'id_category' => 'int',
		'photo_order' => 'int'
	];

	protected $fillable = [
		'id_category',
		'photo_order',
		'photo_render',
		'photo_alt'
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'id_category');
	}
}
