<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Member
    Route::apiResource('members', 'MemberApiController');

    // Jobs
    Route::apiResource('jobs', 'JobsApiController');
});
