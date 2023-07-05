<div class="row">

    <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
        <div class="mb-4 text-center text-md-right">
            <h5 class="font-weight-bold">ویرایش فیلم: <?= $movie-> title_fa ?></h5>
        </div>
        <hr>
        <form action="<?= '/admin/movies/update/'. $movie->id ?>" method="POST">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="title_fa">عنوان فارسی</label>
                    <input class="form-control" id="title_fa" name="title_fa" type="text" value="<?= $movie->title_fa ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="title_en">عنوان انگلیسی</label>
                    <input class="form-control" id="title_en" name="title_en" type="text" value="<?= $movie->title_en ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="movie_url">لینک</label>
                    <input class="form-control" id="movie_url" name="movie_url" type="text" value="<?= $movie->movie_url ?>">
                </div>

                <div class="form-group col-md-12">
                    <label for="description_fa">توضیحات فارسی</label>
                    <textarea class="form-control" id="description_fa" name="description_fa"
                              type="text"><?= $movie->description_fa ?></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="description_en">توضیحات انگلیسی</label>
                    <textarea class="form-control" id="description_en" name="description_en"
                              type="text"><?= $movie->description_en ?></textarea>
                </div>

            </div>
            <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
            <a href="/admin/movies" class="btn btn-dark mt-5 mr-3">بازگشت</a>
        </form>
    </div>
</div>