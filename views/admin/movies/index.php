<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
        <div class="mb-4 d-flex flex-column text-center flex-md-row justify-content-md-between">
            <h5 class="font-weight-bold mb-3 mb-md-0">لیست فیلم ها (<?= $totalMovies ?>)</h5>
            <div>
                <a class="btn btn-sm btn-outline-primary" href="/admin/movies/create">
                    <i class="fa fa-plus"></i>
                    ایجاد فیلم
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>آی دی</th>
                    <th>عنوان فیلم</th>
                    <th>توضیحات</th>
                    <th>لینک</th>
                    <th>عملیات</th>
                </tr>

                </thead>
                <tbody>
                <?php
                foreach ($movies as $key => $movie) :
                    ?>
                    <tr>
                        <th><?= $movie['id'] ?></th>
                        <th>
                            <?= $movie['title_fa'] ?>
                        </th>
                        <th>
                            <?= $movie['description_fa'] ?>
                        </th>
                        <th>
                            <a target="_blank" href="<?= $movie['movie_url'] ?>"><?= $movie['movie_url'] ?></a>
                        </th>
                        <th>
                            <form action="<?= '/admin/movies/delete/'.$movie['id'] ?>" method="post">
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this movie?')">حذف
                                </button>
                            </form>

                            <a class="btn btn-sm btn-outline-info mr-3 mt-3"
                               href="<?= '/admin/movies/edit/'. $movie['id'] ?>">ویرایش</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <?php for ($i = 1; $i <= ceil($totalMovies / $perPage); $i++) : ?>
                <a href="?page=<?= $i ?>"<?= $currentPage == $i ? ' class="active"' : '' ?>> &nbsp;&nbsp;<?= $i ?>&nbsp;&nbsp; </a>
            <?php endfor; ?>
        </div>
    </div>
</div>
