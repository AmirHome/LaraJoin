# How to join three table by Laravel eloquent model

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## My schema 

<p align="center"><img src="http://www.amirhome.com//public/uploads/lessons/schema-How-to-join-three-table-by-laravel-eloquent-model-php-mysql-laravel.PNG"></p>

I have three table:

- Articles table
- Categories table
- Users table

I want to show articles with their category name instead of category_id and user_name instead of user_id I try like these query It is work!
But I want to do by Eloquent way.

```
$articles =DB::table('articles')
                ->join('categories', 'articles.id', '=', 'categories.id')
                ->join('users', 'users.id', '=', 'articles.user_id')
                ->select('articles.id','articles.title','articles.body','users.username', 'category.name')
                ->get();
```
 Please, how could I do?

## Learning Laravel Eloquent for Join

With Eloquent its very easy to retrieve relational data checkout following example with your senario in Laravel 5, we have three models:

- Article (belongs to user and category)
- Category (has many articles)
- User (has many articles)

#### Article Model

```
class Article extends Model
{
    //
    protected $fillable = [
        'title', 'text', 'user_id','categories_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
```

#### Category Model

```
class Category extends Model
{
    //
    protected $fillable = [
        'name',
    ];
	
	public function articles()
	{
		return $this->HasMany('App\Article');
	}

}
```

#### User Model

```
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        
    public function articles()
    {
        return $this->HasMany('App\Article');
    }
}
```

### Home Controller
```
    public function index()
    {
        //
    	$articles = Article::with(['user', 'category'])->get();

    	$users = User::with('articles')->get();

    	$categories = Category::with('articles')->get();

        dd(['articles' => $articles->toarray(),
        	'users' => $users->toarray(),
        	'categories' => $categories->toarray(),
        ]);
    }
```

### Result
<p align="center"><img src="http://www.amirhome.com//public/uploads/lessons/result-How-to-join-three-table-by-laravel-eloquent-model-php-mysql-laravel.PNG"></p>
