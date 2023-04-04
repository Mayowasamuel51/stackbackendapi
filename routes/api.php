<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GetController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\SitewideSearchController;




// codardevelopernetwork
// codardeveloper

// create a problem request     .........................
Route::post('/codardeveloper', [FormController::class, 'storegig']);    // done 

// search for  titles, problems ...
Route::get('/codardeveloper/{title}', [GetController::class,'searchTitle']);

// post and answer  for a given problem
Route::post('/codardeveloper/{question_martic}/{title}', [GetController::class,'createanswer']);


/// this is to show the answer or comment base on a post question
//  when the codardeveloper/title posting is working . the id for the codardeveloper/title will appended below
Route::get('/codardeveloper/answer/{id}', [GetController::class,'showanswer']);

/// need to build a search engine for finding languges 



// need to display all question on the api 
Route::get('/getquestions', [GetController::class,'allQuestion']);
// showing title and answer to the question not cant add a comment 
Route::get('/questions/{id}/{ptitle}', [GetController::class,'answerOne']);






////testing
Route::post('/comment/{id}', [FormController::class,'developercomment']);
Route::get('/comment/{id}', [FormController::class,'comments']);
//// test ends



//create a api for  popular problem pages.....







Route::get('/images', [FormController::class, 'image']);


// create
Route::post('/post/javascript',[FormController::class,  'storejavascript']);
Route::post('/post/html',[FormController::class,  'storehtml']);

Route::post('/post/bootstrap',[FormController::class,  'storebootstarp']);
Route::post('/post/tailwind',[FormController::class,  'storetailwind']);

Route::post('/post/expressjs',[FormController::class,  'storeexpressjs']);
Route::post('/post/nodejs',[FormController::class,  'storenodejs']);

Route::post('/post/deveops',[FormController::class,  'storedeveops']);
Route::post('/post/uiux',[FormController::class,  'storeuiux']);

Route::post('/post/css',[FormController::class,  'storecss']);

Route::post('/post/sql',[FormController::class,  'storesql']);
Route::post('/post/monogdb',[FormController::class,  'storemonogdb']);


Route::post('/post/reactjs',[FormController::class,  'storereactjs']);
Route::post('/post/nextjs',[FormController::class,  'storenextjs']);


Route::post('/post/datascience',[FormController::class,  'storedatascience']);
Route::post('/post/php',[FormController::class,  'storephp']);

Route::post('/post/python',[FormController::class,  'storepython']);
Route::post('/post/django',[FormController::class,  'storedjango']);

Route::post('/post/mysql',[FormController::class,  'storemysql']);
Route::post('/post/git',[FormController::class,  'storegit']);




Route::post('/post/',[FormController::class,  'storedatascience']);
Route::post('/post/php',[FormController::class,  'storephp']);





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
