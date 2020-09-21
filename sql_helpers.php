<?php

// sql_helpers.php

function sql_connect($host, $user, $password, $database) {

    $connection =
        mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno())
        die(mysqli_connect_error());

    return $connection;
}

function sql_close($connection) {

    if ($connection)
        mysqli_close($connection);

}

function sql_fetch_array(string $query, array $result) {

    if (!isset($result[0]))
        return $result;

    $first = $result[0];

    foreach ($first as $key => $value) {
        $key = strtolower($key);

        if (preg_match('/count\(.+\)/', $key))
            return (int)$value;

        if (preg_match('/exists\(.+\)/', $key))
            return (bool)$value;

    }

    return $result;
}

function sql_query($connection, $query) {

    $result = mysqli_query($connection, $query);

    if (mysqli_errno($connection)) {
        die( mysqli_error($connection) );
    }

    if (is_bool($result))
        return $result;

    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (is_array($result))
        return sql_fetch_array($query, $result);

    return $result;
}

function sql_escape($connection, string $str): string {
    return mysqli_real_escape_string($connection, $str);
}

function sql_build_columns($connection, $columns) {

    if (is_array($columns)) {
        $columns = array_map(function ($column) use ($connection) {
            return sql_escape($connection, $column);
        }, $columns);
        return '(' . implode(',', $columns) . ')';
    }

    return sql_escape($connection, $columns);
}

function sql_build_where($connection, array $where): string {
    if(empty($where))
        return '';

    $result = [];
    foreach ($where as $column => $value) {
        $result[] = sql_escape($connection, $column) . '=' . "'" . sql_escape($connection, $value) . "'";
    }

    return 'WHERE ' . implode(' AND ', $result);
}

function sql_select($connection, $table, $columns = "*", array $where = []) {
    $table = sql_escape($connection, $table);
    $columns = sql_build_columns($connection, $columns);
    $where = sql_build_where($connection, $where);
    $query = "SELECT {$columns} FROM {$table} {$where}";
    return sql_query($connection, $query);
}

function sql_insert($connection, $table, array $values) {
    $table = sql_escape($connection, $table);
    $query = "INSERT INTO {$table} VALUES (";
    $queryValues = [];
    foreach ($values as $value) {
        $queryValues[] = is_string($value) ? "'" . sql_escape($connection, $value) . "', " : sql_escape($connection, $value);
    }
    $query .= implode(',', $queryValues);
    return sql_query($connection, $query);
}

function sql_update($connection, $table, array $values, array $where) {
    $table = sql_escape($connection, $table);
    $query = "UPDATE {$table} SET ";
    $queryValues = [];
    foreach ($values as $key => $value) {
        $queryValues[] = sql_escape($connection, $key) . '=' . (is_string($value) ? "'" . sql_escape($connection, $value) . "'" : sql_escape($connection, $value));
    }
    $query .= implode(',', $queryValues) . ' ';
    $query .= sql_build_where($connection, $where);
    return sql_query($connection, $query);
}

function sql_delete($connection, $table, array $values) {
    $table = sql_escape($connection, $table);
    $query = "DELETE FROM {$table} " . sql_build_where($connection, $values);
    return sql_query($connection, $query);
}