<?php

/** @var $model \app\models\LoginForm */

use thecodeholic\phpmvc\form\Form;

?>

<h1>ایجاد فیلم:</h1>


<form id="movieForm" action="/admin/movies/store" method="POST">
    <div class="form-group col-md-6">
        <label for="movie_url">لینک مورد نظر:</label><br>
        <i>Exp: https://episode.club/movies/10000472</i>
        <input class="form-control" id="movieUrl" name="movieUrl" type="text" placeholder="Enter Link">
        <button id="submitButton" type="submit" hidden>Submit</button>
    </div>
</form>

<a id="get-movie-info" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
    <button class="btn btn-primary">نمایش جزئیات فیلم</button>
</a>


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> نمایش جزئیات فیلم </h5>
                <button class="close ml-0" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="title_fa">عنوان فارسی فیلم</label>
                        <input class="form-control" id="title_fa" name="title_fa" type="text" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title_en">عنوان انگلیسی فیلم</label>
                        <input class="form-control" id="title_en" name="title_en" type="text" disabled>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description_fa">توضیحات فارسی</label>
                        <textarea class="form-control" id="description_fa" name="description_fa" type="text"
                                  disabled>
                    </textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description_en">توضیحات انگلیسی</label>
                        <textarea class="form-control" id="description_en" name="description_en" type="text"
                                  disabled>
                    </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form action="" method="post" id="logout">
                    <a class="btn btn-primary" href=""
                       onclick="event.preventDefault(); document.getElementById('movieForm').submit();">
                        ذخیره </a>
                </form>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">کنسل</button>
            </div>
        </div>
    </div>
</div>
