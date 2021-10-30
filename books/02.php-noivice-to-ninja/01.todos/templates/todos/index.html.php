<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title text-center">Tạo việc cần làm hôm nay</div>

                    <form action="/todos" method="POST">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Ngày</label>
                            <input name="todo[date]" pattern="\d{4}-\d{2}-\d{2}" value="<?= $today ?>" type="date"
                                   class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput2" class="form-label">Tiêu đề</label>
                            <input name="todo[title]" type="text" class="form-control" id="exampleFormControlInput2"
                                   autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput3" class="form-label">Mô tả</label>
                            <textarea name="todo[content]" class="form-control"
                                      id="exampleFormControlInput3"></textarea>
                        </div>
                        <hr>
                        <input type="submit" value="Tạo mới" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if (count($today_todos) > 0): ?>
    <div class="container">
        <div class="row mt-5 g-3">
            <?php foreach ($today_todos as $todo): ?>
            <div class="col-md-6">
                <div class="card <?= $todo->completed_at ? 'border-success' : 'border-danger' ?>">
                    <div class="card-header"><?= (DateTime::createFromFormat('Y-m-d', $todo->date))->format('d-m-Y') ?></div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <?= $todo->title ?>
                        </li>
                        <li class="list-group-item">
                            <?= $todo->content ?>
                        </li>
                        <li class="list-group-item d-flex">
                            <form action="<?= $todo->completed_at ? '/todos/doing' : '/todos/complete' ?>" class="me-auto" method="POST">
                                <input type="hidden" name="id" value="<?= $todo->id ?>">
                                <input type="submit" value="<?= $todo->completed_at ? 'Hoàn tác' : 'Hoàn thành' ?>" class="btn btn-success">
                            </form>
                            
                            <a href="/todos/edit?id=<?= $todo->id ?>" class="btn btn-warning me-3">Sửa</a>

                            <form action="/todos/delete" method="POST">
                                <input type="hidden" name="id" value="<?= $todo->id ?>">
                                <input type="submit" value="Xóa" class="btn btn-danger">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <?php endforeach;; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
