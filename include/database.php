<?php
    function connect()
    {
        $code = @mysqli_connect("localhost", "root", "123456");
        mysqli_select_db($code, "vegetable");
        return $code;
    }

    function view(string $query)
    {
        $code = connect();
        $kq = mysqli_query($code, $query);
        mysqli_close($code);
        return $kq;
    }

    function countPage( string $query)
    {
        $code = connect();
        $kq = mysqli_query($code, $query);
        if ($kq) {
            $row = mysqli_fetch_assoc($kq);
            $page = (int) $row['total_rows'];
            return  ceil($page / 6);
        } else {
            return 0;
        }
    }

    function create($code, string $query)
    {
        $kq = mysqli_query($code, $query);
        mysqli_close($code);
    }

    function delete(string $query)
    {
        $code = connect();
        $kq = mysqli_query($code, $query);
        mysqli_close($code);
    }

    function update(string $query)
    {
        $code = connect();
        $kq = mysqli_query($code, $query);
        mysqli_close($code);
        return $kq;
    }
?>