<?php
$name = htmlspecialchars($_POST['name'] ?? "");
$name = trim($name);
$tel_number = htmlspecialchars($_POST['tel_number'] ?? "");
$tel_number = trim($tel_number);
$jsonArray = [];

//Чтение файла
if (file_exists('data.json')) {
    $json = file_get_contents('data.json');
    $jsonArray = json_decode($json, true);
}

//Добавление в файл
if ($name && $tel_number) {
    $jsonArray[] = [$name, $tel_number];
    file_put_contents('data.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
    header("Location:" . $_SERVER['HTTP_REFERER']);

}

//Удаление
if (isset($_POST['del'])) {
    $key = $_POST['key'] - 1;
    unset($jsonArray[$key]);
    file_put_contents('data.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
    header("Location:" . $_SERVER['HTTP_REFERER']);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Name and Phone Number on php and json</title>
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Введите:
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <p>Имя: <input type="text" class="form control" name="name" /></p>
                                            <p>Номер телефона: <input type="tel" class="form control"
                                                    name="tel_number" /></p>
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
                                <th scope="col" class="text-center">Имя</th>
                                <th scope="col" class="text-center">Телефонный номер</th>
                                <th scope="col" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($jsonArray) && is_array($jsonArray)):
                                $key = 0;
                                foreach ($jsonArray as $index => $data):
                                    $key++; ?>

                                    <tr>
                                        <th scope="row"><?php echo $key ?></th>
                                        <td><?php echo $data[0] ?></td>
                                        <td><?php echo $data[1] ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal"
                                                data-bs-target="#delete<?php echo $key; ?>">Удалить</button>
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
                            <?php endif; ?>
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