<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="MT" />
    <meta name="author" content="MT" />
    <title>Tạo mới người dùng</title>
    <link href="../resources/css/styles.css" rel="stylesheet" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    $(document).ready(() => {
        const avatarFile = $("#avatarFile");
        avatarFile.change(function(e) {
            const imgURL = URL.createObjectURL(e.target.files[0]);
            $("#avatarPreview").attr("src", imgURL);
            $("#avatarPreview").css({
                "display": "block"
            });
        });
    });
    </script>

</head>

<body class="sb-nav-fixed">
    <?php include_once '../layout/header.php'?>
    <div id="layoutSidenav">
        <?php include_once '../layout/sidebar.php'?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Manage Users</h1>
                    <?php
                        if(!empty($_POST))
                        {
                            $email = isset($_POST['email']) ? $_POST['email'] : '';
                            $password = isset($_POST['password']) ? $_POST['password'] : '';
                            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                            $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
                            $roleID = isset($_POST['roleID']) ? (int)$_POST['roleID'] : 1;
                            $error = [];
                            if(empty($_POST['email']))
                            {
                                $error['email'] = 'Email không được để trông';
                            }

                            if(empty($_POST['password']))
                            {
                                $error['password']['required'] = 'password không được để trông';
                            }
                            else
                            {
                                if(strlen($_POST['password']) < 6)
                                $error['password']['length'] = 'password không được nhỏ hơn 6 kí tự';
                            }

                            if(empty($_POST['fullname']))
                            {
                                $error['fullname']['required'] = 'tên không được để trông';
                            }
                            else
                            {
                                if(strlen($_POST['fullname']) < 2)
                                $error['fullname']['length'] = 'tên không được nhỏ hơn 2 kí tự';
                            }

                            if (preg_match('/[a-zA-Z]/', $_POST['phone'])) {
                                $error['phone']['invalid'] = 'Vui lòng nhập đúng định dạng số điện thoại';
                            } else {
                                if(strlen($_POST['phone']) < 9)
                                    $error['phone']['length'] = 'Số điện thoại phải có 9 chữ số';
                            }
                        }
                    ?>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="/admin">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Người dùng</li>
                    </ol>
                    <div class="mt-5">
                        <div class="row">
                            <div class="col-md-6 col-12 mx-auto">
                                <h3>Tạo một người dùng</h3>
                                <hr />
                                <form method="post" action="" enctype="multipart/form-data" class="row">
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Email:</label>
                                        <input type="email"
                                            class="form-control <?php echo !empty($error['email']) ? 'is-invalid' : ''; ?>"
                                            name="email" value="<?php echo isset($email) ? $email : ''; ?>" />
                                        <?php echo !empty($error['email']) ? '<div class="invalid-feedback">' . $error['email'] . '</div>' : ''; ?>
                                    </div>

                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Mật khẩu:</label>
                                        <input type="password"
                                            class="form-control <?php echo !empty($error['password']) ? 'is-invalid' : ''; ?>"
                                            name="password" value="<?php echo isset($password) ? $password : ''; ?>" />
                                        <?php echo !empty($error['password']['required']) ? '<div class="invalid-feedback">' . $error['password']['required'] . '</div>' : ''; ?>
                                        <?php echo !empty($error['password']['length']) ? '<div class="invalid-feedback">' .$error['password']['length'] . '</div>' : ''; ?>
                                    </div>

                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Số điện thoại:</label>
                                        <input type="text"
                                            class="form-control <?php echo !empty($error['phone']) ? 'is-invalid' : ''; ?>"
                                            name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" />
                                        <?php echo !empty($error['phone']['invalid']) ? '<div class="invalid-feedback">' . $error['phone']['invalid'] . '</div>' : ''; ?>
                                        <?php echo !empty($error['phone']['length']) ? '<div class="invalid-feedback">' .$error['phone']['length'] . '</div>' : ''; ?>
                                    </div>

                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Tên đầy đủ:</label>
                                        <input type="text"
                                            class="form-control <?php echo !empty($error['fullname']) ? 'is-invalid' : ''; ?>"
                                            name="fullname" value="<?php echo isset($fullname) ? $fullname : ''; ?>" />
                                        <?php echo !empty($error['fullname']['required']) ? '<div class="invalid-feedback">' . $error['fullname']['required'] . '</div>' : ''; ?>
                                        <?php echo !empty($error['fullname']['length']) ? '<div class="invalid-feedback">' .$error['fullname']['length'] . '</div>' : ''; ?>
                                    </div>

                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Vị trí:</label>
                                        <select class="form-select" name="roleID">
                                            <option value="2">ADMIN</option>
                                            <option value="1">USER</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="avatarFile" class="form-label">Ảnh đại diện:</label>
                                        <input class="form-control" type="file" id="avatarFile"
                                            accept=".png, .jpg, .jpeg" name="MinhTriFile" />
                                    </div>
                                    <div class="col-12 mb-3">
                                        <img style="max-height: 250px; display: none;" alt="avatar preview"
                                            id="avatarPreview" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tạo người dùng</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </main>
            <?php 
            include_once '../layout/footer.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                include_once '../../../include/database.php';
                $code = connect();
                $file = time().".jpg";
                $tenFile = "C:/xampp/htdocs/Shop Vegetable/img/avatar/".$file;
                $result = move_uploaded_file($_FILES['MinhTriFile']['tmp_name'], $tenFile);
                $query =  "INSERT INTO user (email, name, password, phone, image, roleID )
                    VALUES ('$email', '$fullname', '$password', '$phone', '$file', '$roleID')";
                $kq = mysqli_query($code, $query);
                mysqli_close($code);
                if ($kq) {
                    echo '<script type="text/javascript">
                            window.location.href = "/SHOP%20VEGETABLE/src/admin/user/show.php?page=1";
                          </script>';
                    exit();
                } else {
                    echo "Error: " . mysqli_error($code);
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="../resources/js/scripts.js"></script>

</body>

</html>