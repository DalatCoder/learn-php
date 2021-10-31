<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center">Chỉnh sửa việc cần làm</div>

                    <form action="/todos/edit" method="POST">
                        <input type="hidden" name="todo[id]" value="<?= $todo->id ?>">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Ngày</label>
                            <input name="todo[date]" pattern="\d{4}-\d{2}-\d{2}" value="<?= $todo->date ?>" type="date"
                                   class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Tiêu đề</label>
                            <input name="todo[title]" type="text" value="<?= $todo->title ?>" class="form-control" id="exampleFormControlInput2"
                                   autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Mô tả</label>
                            <textarea name="todo[content]" class="form-control"
                                      id="exampleFormControlInput3"><?= $todo->content ?></textarea>
                        </div>
                        <hr>
                        <input type="submit" value="Cập nhật" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
