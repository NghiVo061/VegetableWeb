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

    function countPage( string $query, int $offset)
    {
        $code = connect();
        $kq = mysqli_query($code, $query);
        if ($kq) {
            $row = mysqli_fetch_assoc($kq);
            $page = (int) $row['total_rows'];
            mysqli_close($code);
            return  ceil($page / $offset);
        } else {
            mysqli_close($code);
            return 0;
        }
    }

    function countSum(string $name)
    {
        $code = connect();
        $query = "SELECT COUNT(*) AS total_rows FROM ".$name;
        $kq = mysqli_query($code, $query);
        if ($kq) {
            $row = mysqli_fetch_assoc($kq);
            $num = (int) $row['total_rows'];
            mysqli_close($code);
            return $num;
        } else {
            mysqli_close($code);
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