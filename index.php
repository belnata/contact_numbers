<?php
$data = htmlspecialchars($_POST['data']);
$data = trim($data);
$jsonArray = [];

//Чтение файла
if (file_exists('data.json')) {
    $json = file_get_contents('data.json');
    $jsonArray = json_decode($json, true);
}

//Добавление в файл
if ($data) {
    $jsonArray[] = $data;
    file_put_contents('data.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
    header("Location:".$_SERVER['HTTP_REFERER']);
}

//Удаление
if (isset($_POST['del'])) {
    unset($jsonArray[$key]);
    file_put_contents('data.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
    header("Location:".$_SERVER['HTTP_REFERER']);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Name_Numbers on php and json</title>
    <meta name="description"
        content="Создание веб-приложения на PHP без использования фреймворков и базы данных. Данные хранятся в файле JSON">
    <style>

    </style>
</head>

<body>
    <section>
        <div class="container mt-3">
            <div class="row justify-content-center">

                <div class="col-12">
                    <!-- Button trigger modal -->
                    <button class="btn btn-success mb-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Добавить</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить Имя и Телефонный номер
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form control" name="data" />
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary">Сохранить</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th scope="col" style="width: 5%;">№</th>
                                <th scope="col" class="text-center">Имя и Телефонный номер</th>
                                <th scope="col" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($jsonArray as $key => $value): ?>
                                <tr>
                                    <th scope="row"><?php echo (int) $key + 1 ?></th>
                                    <td><?php echo $value ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal"
                                            data-bs-target="#delete<?php echo $key; ?>"><i
                                                class="fas fa-trash"></i>Удалить</button>
                                        <!-- Modal delete -->
                                        <div class="modal fade" id="delete<?php echo $key; ?>" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Удалить запись
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <div class="form-group">
                                                                <input type="hidden" class="form control" name="key"
                                                                    value="<?php echo $key; ?>">
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-danger" name="del">Удалить</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </section>
</body>
</html>