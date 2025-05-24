<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsbe extends Model
{
    use HasFactory;
    protected $table = 'news';

    protected $fillable = [
       'users_id',
        'dept_id',
        'role_id',
        'title',
        'description',
        'category',
        'status',
        'slug',
        'excerpt',
        'meta_description',
        'published_at',
        'views_count',
        'pic',
        'created_by',
        'updated_by'
    ];

    public $timestamps = false;

     protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [];
        protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate slug if not provided
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }

            // Generate excerpt if not provided
            if (empty($model->excerpt)) {
                $model->excerpt = Str::limit(strip_tags($model->description), 200);
            }

            // Set published_at if status is published and published_at is not set
            if ($model->status === 'published' && empty($model->published_at)) {
                $model->published_at = now();
            }
        });

        static::updating(function ($model) {
            // Update slug if title changed and slug is empty
            if ($model->isDirty('title') && empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }

            // Update excerpt if not provided
            if (empty($model->excerpt)) {
                $model->excerpt = Str::limit(strip_tags($model->description), 200);
            }

            // Set published_at if status changed to published and published_at is not set
            if ($model->isDirty('status') && $model->status === 'published' && empty($model->published_at)) {
                $model->published_at = now();
            }
        });
    }

    /**
     * Scope a query to only include published news.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include draft news.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to filter by category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get the user that created the news.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * Get the department that the news belongs to.
     */
    public function department()
    {
        return $this->belongsTo('App\Department', 'dept_id');
    }

    /**
     * Get the role that the news belongs to.
     */
    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the URL for the news article.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return url('/news/' . $this->slug);
    }

    /**
     * Get the formatted published date.
     *
     * @return string
     */
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y H:i') : null;
    }

    /**
     * Check if the news is published.
     *
     * @return bool
     */
    public function getIsPublishedAttribute()
    {
        return $this->status === 'published' &&
               $this->published_at &&
               $this->published_at <= now();
    }

    /**
     * Get the status badge class.
     *
     * @return string
     */
    public function getStatusBadgeClassAttribute()
    {
        switch ($this->status) {
            case 'published':
                return 'badge-success';
            case 'draft':
                return 'badge-warning';
            case 'archived':
                return 'badge-secondary';
            default:
                return 'badge-light';
        }
    }

    /**
     * Get the category badge class.
     *
     * @return string
     */
    public function getCategoryBadgeClassAttribute()
    {
        switch ($this->category) {
            case 'announcement':
                return 'badge-danger';
            case 'event':
                return 'badge-primary';
            case 'update':
                return 'badge-info';
            case 'promotion':
                return 'badge-success';
            case 'education':
                return 'badge-warning';
            default:
                return 'badge-secondary';
        }
    }

    /**
     * Increment the views count.
     *
     * @return bool
     */
    public function incrementViews()
    {
        return $this->increment('views_count');
    }

}
