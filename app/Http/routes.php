<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function(){
    //Route::Auth();
	$this->get('inter-backend', ['as' => 'internal.login', 'uses' => 'Auth\AuthController@showLoginForm']);
	$this->post('chk-login-bkn', ['as' => 'internal.post.login', 'uses' => 'Auth\AuthController@login']);
	$this->get('inter-logout', ['as' => 'internal.logout', 'uses' => 'Auth\AuthController@logout']);

	// Registration Routes...
	$this->get('register', 'Auth\AuthController@showRegistrationForm');
	$this->post('register', 'Auth\AuthController@register');

	// Password Reset Routes...
	$this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	$this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	$this->post('password/reset', 'Auth\PasswordController@reset');

	Route::get('/',                             ['as' => 'home.page', 'uses' => 'HomeController@index']);
    Route::get('/loading-partner',              ['as' => 'loading.partner', 'uses' => 'AjaxController@loadingPartner']);
    Route::get('/loading-image-slideshow',      ['as' => 'loading.slideshow', 'uses' => 'AjaxController@loadingSlideshow']);
    Route::get('/loading-training-course',      ['as' => 'training.course.pagination', 'uses' => 'AjaxController@loadingTrainingCourse']);
    Route::get('/loading-customize-training',   ['as' => 'customize.training.pagination', 'uses' => 'AjaxController@loadingCustomizeTraining']);
    Route::get('/loading-resources',            ['as' => 'loading.resource.pagination', 'uses' => 'AjaxController@loadingResource']);
    Route::get('/get-free-resources',           ['as' => 'download.free.resource', 'uses' => 'HomeController@download']);
    Route::get('/loading-job-vacancy',          ['as' => 'loading.job.pagination', 'uses' => 'AjaxController@loadingJob']);
    Route::post('/search-job-vacancy',          ['as' => 'loading.job.search', 'uses' => 'AjaxController@loadingJobSearch']);
    Route::get('/clear-job-results',            ['as' => 'clear.job.result', 'uses' => 'AjaxController@clearJobResult']);
    Route::get('/odi-member-login',             ['as' => 'odi.member.login', 'uses' => 'Auth\AuthController@member_login']);
    Route::post('/member-login',                ['as' => 'check.member.login', 'uses' => 'Auth\AuthController@check_member_login']);

    Route::get('/send-mail',                    ['as' => 'send.mail', 'uses' => 'MailController@index']);
    Route::get('/alert-job',                    ['as' => 'alert.job', 'uses' => 'MailController@sendJobAlert']);
    Route::get('/alert-training',               ['as' => 'alert.training', 'uses' => 'MailController@sendTrainingAlert']);
    Route::get('/file/share-document',          ['as' => 'share.document', 'uses' => 'ZipperController@generateLinkShare']);

    Route::get('/job-alert-setting',            ['as' => 'criteria.setting', 'uses' => 'HomeController@settingAlertJob']);
    Route::post('/save-alert-setting',          ['as' => 'save.criteria.setting', 'uses' => 'HomeController@saveAlertJob']);

    Route::post('/submit-register-online',      ['as' => 'submit.register.online', 'uses' => 'HomeController@registerOnline']);
    Route::post('/submit-candidate-cv',         ['as' => 'submit.candidate.cv', 'uses' => 'HomeController@candidateCV']);
    Route::post('/odi-finding-result',          ['as' => 'find.result', 'uses' => 'HomeController@searchContent']);
    Route::get('/job-detail-{job_id}-{job_title}',['as' => 'job.detail.page', 'uses' => 'HomeController@jobDetail']);
    Route::get('/training-course-detail-{training_id}-{training_title}', ['as' => 'training.detail.page', 'uses' => 'HomeController@trainingDetail']);
    Route::get('/{slug}',                       ['as' => 'display.page',  'uses' => 'HomeController@page']);

});

/* Backend Internal User */
Route::group(['prefix' => 'internal-bkn', 'middleware' => ['web','auth']], function () {
    Route::get('/dashboard',       ['as' => 'admin.dashboard', 	     'uses' => 'BackendController@getDashboard']);
    Route::get('/change-password', ['as' => 'admin.change.password', 'uses' => 'BackendController@changePassword']);
    Route::post('/update-password',['as' => 'admin.update.password', 'uses' => 'BackendController@updatePassword']);
    Route::get('/check-password',  ['as' => 'admin.check.password',  'uses' => 'BackendController@checkCurrentPassword']);

    Route::get('/manage-menu',  ['as' => 'admin.menu.list', 	'uses' => 'BackendMenuController@index']);
    Route::get('/loading-menu-list', ['as' => 'admin.menu.pagination', 'uses' => 'BackendMenuController@pagination']);
    Route::get('/create-menu',  ['as' => 'admin.menu.create', 	'uses' => 'BackendMenuController@create']);
    Route::post('/insert-menu', ['as' => 'admin.menu.insert', 	'uses' => 'BackendMenuController@store']);
    Route::get('/edit-menu',    ['as' => 'admin.menu.edit', 	'uses' => 'BackendMenuController@edit']);
    Route::post('/update-menu', ['as' => 'admin.menu.update', 	'uses' => 'BackendMenuController@update']);
    Route::post('/search-menu', ['as' => 'admin.menu.search', 	'uses' => 'BackendMenuController@search']);
    Route::get('/delete-menu',  ['as' => 'admin.menu.delete', 	'uses' => 'BackendMenuController@destroy']);
    Route::get('/change-status-menu', ['as' => 'admin.menu.status', 	 'uses' => 'BackendMenuController@updateStatus']);
    Route::get('/content-type-menu',  ['as' => 'admin.menu.content.type','uses' => 'BackendMenuController@changeContentType']);
    Route::get('/check-link-menu',    ['as' => 'admin.menu.checklink', 	 'uses' => 'BackendMenuController@checkLink']);

    Route::get('/manage-article',       ['as' => 'admin.article.list', 	 'uses' => 'BackendArticleController@index']);
    Route::get('/loading-article-list', ['as' => 'admin.article.pagination', 'uses' => 'BackendArticleController@pagination']);
    Route::get('/create-article',       ['as' => 'admin.article.create', 'uses' => 'BackendArticleController@create']);
    Route::post('/insert-article',      ['as' => 'admin.article.insert', 'uses' => 'BackendArticleController@store']);
    Route::get('/edit-article',         ['as' => 'admin.article.edit', 	 'uses' => 'BackendArticleController@edit']);
    Route::post('/update-article',      ['as' => 'admin.article.update', 'uses' => 'BackendArticleController@update']);
    Route::post('/search-article',      ['as' => 'admin.article.search', 'uses' => 'BackendArticleController@search']);
    Route::get('/delete-article',       ['as' => 'admin.article.delete', 'uses' => 'BackendArticleController@destroy']);
    Route::get('/change-status-article',['as' => 'admin.article.status', 'uses' => 'BackendArticleController@updateStatus']);

    Route::get('/manage-contact',  ['as' => 'admin.contact.list', 		 'uses' => 'BackendArticleController@contact']);
    Route::post('/update-contact', ['as' => 'admin.contact.update', 	 'uses' => 'BackendArticleController@contactUpdate']);

    Route::get('/manage-category', ['as' => 'admin.category.list',       'uses' => 'BackendCategoryController@index']);
    Route::get('/loading-category-list',['as' => 'admin.category.pagination',  'uses' => 'BackendCategoryController@pagination']);
    Route::get('/create-category', ['as' => 'admin.category.create', 	 'uses' => 'BackendCategoryController@create']);
    Route::post('/insert-category',['as' => 'admin.category.insert', 	 'uses' => 'BackendCategoryController@store']);
    Route::get('/edit-category',   ['as' => 'admin.category.edit', 		 'uses' => 'BackendCategoryController@edit']);
    Route::post('/update-category',['as' => 'admin.category.update', 	 'uses' => 'BackendCategoryController@update']);
    Route::post('/search-category',['as' => 'admin.category.search', 	 'uses' => 'BackendCategoryController@search']);
    Route::get('/delete-category', ['as' => 'admin.category.delete',     'uses' => 'BackendCategoryController@destroy']);
    Route::get('/change-status-category',['as' => 'admin.category.status','uses'=> 'BackendCategoryController@updateStatus']);
    Route::get('/change-front-category',['as' => 'admin.category.front','uses'  => 'BackendCategoryController@updateFront']);

    Route::get('/manage-sub-category', ['as' => 'admin.subcategory.list','uses' => 'BackendCategorySubController@index']);
    Route::get('/loading-sub-category-list',['as' => 'admin.subcategory.pagination',  'uses' => 'BackendCategorySubController@pagination']);
    Route::get('/create-sub-category', ['as' => 'admin.subcategory.create',     'uses' => 'BackendCategorySubController@create']);
    Route::post('/insert-sub-category',['as' => 'admin.subcategory.insert',     'uses' => 'BackendCategorySubController@store']);
    Route::get('/edit-sub-category',   ['as' => 'admin.subcategory.edit',       'uses' => 'BackendCategorySubController@edit']);
    Route::post('/update-sub-category',['as' => 'admin.subcategory.update',     'uses' => 'BackendCategorySubController@update']);
    Route::post('/search-sub-category',['as' => 'admin.subcategory.search',     'uses' => 'BackendCategorySubController@search']);
    Route::get('/delete-sub-category', ['as' => 'admin.subcategory.delete',     'uses' => 'BackendCategorySubController@destroy']);
    Route::get('/change-status-sub-category',['as' => 'admin.subcategory.status','uses'=> 'BackendCategorySubController@updateStatus']);

	Route::get('/manage-slideshow',        ['as' => 'admin.slideshow.list', 	 'uses' => 'BackendSlideshowController@index']);
    Route::get('/loading-slideshow-list',  ['as' => 'admin.slideshow.pagination','uses' => 'BackendSlideshowController@pagination']);
    Route::post('/insert-slideshow',       ['as' => 'admin.slideshow.insert',    'uses' => 'BackendSlideshowController@store']);
    Route::get('/change-status-slideshow', ['as' => 'admin.slideshow.status',    'uses' => 'BackendSlideshowController@updateStatus']);
    Route::get('/delete-slideshow',        ['as' => 'admin.slideshow.delete',    'uses' => 'BackendSlideshowController@destroy']);
    Route::get('/re-order',                ['as' => 'admin.slideshow.reorder',   'uses' => 'BackendSlideshowController@reOrder']);
    Route::get('/create-slideshow',        ['as' => 'admin.slideshow.create',    'uses' => 'BackendSlideshowController@create']);
    Route::post('/insert-slideshow',       ['as' => 'admin.slideshow.insert',    'uses' => 'BackendSlideshowController@store']);
    Route::get('/edit-slideshow',          ['as' => 'admin.slideshow.edit',      'uses' => 'BackendSlideshowController@edit']);
    Route::post('/update-slideshow',       ['as' => 'admin.slideshow.update',    'uses' => 'BackendSlideshowController@update']);
    Route::post('/search-slideshow',       ['as' => 'admin.slideshow.search',    'uses' => 'BackendSlideshowController@search']);

	Route::get('/manage-gallery',       ['as' => 'admin.gallery.list', 		 'uses' => 'BackendGalleryController@index']);
    Route::get('/loading-gallery-list', ['as' => 'admin.gallery.pagination', 'uses' => 'BackendGalleryController@pagination']);
    Route::any('/insert-gallery',       ['as' => 'admin.gallery.insert', 	 'uses' => 'BackendGalleryController@store']);
    Route::post('/search-gallery',      ['as' => 'admin.gallery.search', 	 'uses' => 'BackendGalleryController@search']);
    Route::get('/delete-gallery',       ['as' => 'admin.gallery.delete', 	 'uses' => 'BackendGalleryController@destroy']);
    Route::get('/change-status-gallery',['as' => 'admin.gallery.status',     'uses' => 'BackendGalleryController@updateStatus']);
    Route::get('/share-gallery',        ['as' => 'admin.gallery.share',      'uses' => 'BackendGalleryController@share']);

    Route::get('/add-photo-gallery/{id}',['as' => 'admin.gallery.addphoto',   'uses' => 'BackendGalleryController@addPhoto']);
    Route::post('/insert-photo-gallery', ['as' => 'admin.gallery.insert.photo','uses'=> 'BackendGalleryController@insertPhoto']);
    Route::get('/delete-photo-gallery',  ['as' => 'admin.gallery.removephoto','uses' => 'BackendGalleryController@removePhoto']);

    Route::get('/manage-resource-type-list',  ['as' => 'admin.resourcetype.list', 'uses'=> 'BackendResourceController@listType']);
    Route::get('/loading-resource-type-list', ['as' => 'admin.resourcetype.pagination','uses'=> 'BackendResourceController@paginationType']);
    Route::get('/insert-resource-type', ['as' => 'admin.resourcetype.insert','uses'=> 'BackendResourceController@insertType']);
    Route::get('/delete-resource-type', ['as' => 'admin.resourcetype.delete','uses'=> 'BackendResourceController@deleteType']);
    Route::post('/search-resource-type', ['as' => 'admin.resourcetype.search','uses'=> 'BackendResourceController@searchType']);

    Route::get('/manage-resource-list', ['as' => 'admin.resource.list', 'uses' => 'BackendResourceController@index']);
    Route::get('/loading-resource-list', ['as' => 'admin.resource.pagination', 'uses' => 'BackendResourceController@pagination']);
    Route::get('/create-resource', ['as' => 'admin.resource.create', 'uses' => 'BackendResourceController@create']);
    Route::post('/insert-resource', ['as' => 'admin.resource.insert', 'uses' => 'BackendResourceController@store']);
    Route::get('/edit-resource', ['as' => 'admin.resource.edit', 'uses' => 'BackendResourceController@edit']);
    Route::post('/update-resource',  ['as' => 'admin.resource.update', 'uses' => 'BackendResourceController@update']);
    Route::post('/search-resource',  ['as' => 'admin.resource.search', 'uses' => 'BackendResourceController@search']);
    Route::get('/delete-resource',   ['as' => 'admin.resource.delete', 'uses' => 'BackendResourceController@destroy']);
    Route::get('/download-resource', ['as' => 'admin.resource.download', 'uses' => 'BackendResourceController@download']);

    Route::get('/manage-training-type-list',  ['as' => 'admin.trainingtype.list', 'uses'=> 'BackendTrainingController@listType']);
    Route::get('/loading-training-type-list', ['as' => 'admin.trainingtype.pagination','uses'=> 'BackendTrainingController@paginationType']);
    Route::get('/insert-training-type', ['as' => 'admin.trainingtype.insert','uses'=> 'BackendTrainingController@insertType']);
    Route::get('/delete-training-type', ['as' => 'admin.trainingtype.delete','uses'=> 'BackendTrainingController@deleteType']);
    Route::post('/search-training-type', ['as' => 'admin.trainingtype.search','uses'=> 'BackendTrainingController@searchType']);    

    Route::get('/manage-training-list', ['as' => 'admin.training.list', 'uses' => 'BackendTrainingController@index']);
    Route::get('/loading-training-list', ['as' => 'admin.training.pagination', 'uses' => 'BackendTrainingController@pagination']);
    Route::get('/create-training', ['as' => 'admin.training.create', 'uses' => 'BackendTrainingController@create']);
    Route::post('/insert-training', ['as' => 'admin.training.insert', 'uses' => 'BackendTrainingController@store']);
    Route::get('/edit-training', ['as' => 'admin.training.edit', 'uses' => 'BackendTrainingController@edit']);
    Route::post('/update-training',  ['as' => 'admin.training.update', 'uses' => 'BackendTrainingController@update']);
    Route::post('/search-training',  ['as' => 'admin.training.search', 'uses' => 'BackendTrainingController@search']);
    Route::get('/delete-training',   ['as' => 'admin.training.delete', 'uses' => 'BackendTrainingController@destroy']);
    Route::get('/group-training',    ['as' => 'admin.training.group',  'uses' => 'BackendTrainingController@groupTraining']);
    Route::get('/change-status-training',['as' => 'admin.training.status', 'uses' => 'BackendTrainingController@updateStatus']);

    Route::get('/manage-training-joined-list', ['as' => 'admin.trainingjoined.list', 'uses' => 'BackendTrainingController@joinedTraining']);
    Route::get('/loading-training-joined-list', ['as' => 'admin.trainingjoined.pagination', 'uses' => 'BackendTrainingController@joinedPagination']);
    Route::post('/search-training-joined', ['as' => 'admin.trainingjoined.search', 'uses' => 'BackendTrainingController@joinedSearch']);
    Route::get('/status-training-joined', ['as' => 'admin.trainingjoined.status', 'uses' => 'BackendTrainingController@joinedStatus']);

    Route::get('/manage-job-list', ['as' => 'admin.job.list', 'uses' => 'BackendRecruitmentController@index']);
    Route::get('/loading-job-list', ['as' => 'admin.job.pagination', 'uses' => 'BackendRecruitmentController@pagination']);
    Route::get('/create-job', ['as' => 'admin.job.create', 'uses' => 'BackendRecruitmentController@create']);
    Route::post('/insert-job', ['as' => 'admin.job.insert', 'uses' => 'BackendRecruitmentController@store']);
    Route::get('/edit-job', ['as' => 'admin.job.edit', 'uses' => 'BackendRecruitmentController@edit']);
    Route::post('/update-job', ['as' => 'admin.job.update', 'uses' => 'BackendRecruitmentController@update']);
    Route::get('/delete-job', ['as' => 'admin.job.delete', 'uses' => 'BackendRecruitmentController@destroy']);
    Route::post('/search-job', ['as' => 'admin.job.search', 'uses' => 'BackendRecruitmentController@search']);
    Route::get('/change-status-job',['as' => 'admin.job.status',     'uses' => 'BackendRecruitmentController@updateStatus']);

    Route::get('/candidate-cv-list', ['as' => 'admin.candidate.list', 'uses' => 'BackendRecruitmentController@candidate']);
    Route::get('/loading-candidate-cv-list', ['as' => 'admin.candidate.pagination', 'uses' => 'BackendRecruitmentController@candidatePagination']);
    Route::post('/search-candidate-cv', ['as' => 'admin.candidate.search', 'uses' => 'BackendRecruitmentController@candidateSearch']);
    Route::get('/download-candidate-cv', ['as' => 'admin.candidate.download', 'uses' => 'BackendRecruitmentController@candidateDownload']);

    Route::get('/manage-user-list', ['as' => 'admin.user.list', 'uses' => 'BackendUserController@index']);
    Route::get('/loading-user-list', ['as' => 'admin.user.pagination', 'uses' => 'BackendUserController@pagination']);
    Route::get('/create-user', ['as' => 'admin.user.create', 'uses' => 'BackendUserController@create']);
    Route::post('/insert-user', ['as' => 'admin.user.store', 'uses' => 'BackendUserController@store']);
    Route::get('/edit-user', ['as' => 'admin.user.edit', 'uses' => 'BackendUserController@edit']);
    Route::post('/update-user', ['as' => 'admin.user.update', 'uses' => 'BackendUserController@update']);
    Route::post('/search-user', ['as' => 'admin.user.search', 'uses' => 'BackendUserController@search']);
    Route::get('/delete-user', ['as' => 'admin.user.delete', 'uses' => 'BackendUserController@destroy']);

    Route::get('/manage-email-setting', ['as' => 'admin.manage.email', 'uses' => 'BackendController@emailSetting']);
    Route::post('/save-email-setting',  ['as' => 'admin.save.email', 'uses' => 'BackendController@saveSetting']);
});