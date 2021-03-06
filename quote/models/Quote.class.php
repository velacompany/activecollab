<?php

/**
 * Calendar manager class
 *
 * @package activeCollab.modules.calendar
 * @subpackage calendar
 */
class Quote
{

    // ---------------------------------------------------
    //  URL Sections
    // ---------------------------------------------------

    /**
     * Return dashboard calendar URL
     *
     * @return string
     */
    static function getProjectQuoteUrl(Project $project)
    {
        return Router::assemble('project_quote', array('project_slug' => '22'));
    }

    function getData()
    {
        $data = array();
        $rs = DB::execute("SELECT * FROM " . TABLE_PREFIX . "quote ORDER BY id DESC ");
        if (is_foreachable($rs)) {
            foreach ($rs as $key => $value) {
                $data[] = $value;

            } // foreach
        } // if
        return $data;
    }

    function getById($id,$table='')
    {
        if($table ==''){
            $table = 'quote';
        }
        $sql = " SELECT * FROM " . TABLE_PREFIX .$table. " WHERE `id` = " . $id .' ORDER BY id DESC ';
        $rs = DB::executeFirstRow($sql);
        return $rs;

    }
    function getQuoteLateId(){
        $sql = " SELECT id FROM " . TABLE_PREFIX . "quote ORDER BY id DESC LIMIT 0,1 ";
        $rs = DB::executeFirstRow($sql);
        return $rs;
    }
    function InsertLastId($table){
        $sql = " SELECT id FROM " . TABLE_PREFIX .$table. " ORDER BY id DESC LIMIT 0,1 ";
        $rs = DB::executeFirstRow($sql);
        return $rs;
    }
    function addQuote($dataArray,$table = '')
    {
        if($table ==''){
            $table = 'quote';
        }

        $query = "INSERT INTO " . TABLE_PREFIX .$table. " SET ";
        foreach ($dataArray as $key => $value) {
            $query .= "`{$key}` = '{$value}', ";
        }

        $query = substr($query, 0, -2);
        $rs = DB::execute($query);
        return $rs;

    }

    function update($data = array(), $condition = array(),$table = '')
    {
        $query = "UPDATE  " . TABLE_PREFIX . $table . " SET ";
        $n = count($data);
        $j = 0;
        foreach ($data as $key => $value) {
            $j++;
            if ($j < $n) {
                $query .= "`{$key}` = '{$value}', ";
            }

            if ($j == $n) {
                $query .= "`{$key}` = '{$value}' ";
            }
        }

        $query .= " WHERE ";
        $i = 0;
        foreach ($condition as $keys => $vals) {
            $i++;
            if ($i = 1) {
                $query .= "`{$keys}` = '{$vals}' ";
            }
            if ($i > 1) {
                $query .= " AND `{$keys}` = `{$vals}` ";
            }
        }
        $rs = DB::execute($query);
        return $rs;
    }
    function delete($where = array(),$table =''){
        if($table ==''){
            $table = 'quote';
        }
        $query = "DELETE FROM ". TABLE_PREFIX . $table. " WHERE ";
        $i = 0;
        $and = "";
        foreach($where as $key=>$value){
            $i++;
            if($i>1){
                $and = " AND";
            }
            $query .=  $and."`{$key}` = '{$value}' " ;
        }

        $rs = DB::execute($query);
        return $rs;
    }
    function get_where($table,$where){
        $data = array();
        $query = '';
        $query = 'SELECT * FROM '.TABLE_PREFIX.$table;
        $query .= " WHERE ";
        $i = 0;
        foreach ($where as $keys => $vals) {
            $i++;
            if ($i = 1) {
                $query .= "`{$keys}` = '{$vals}' ";
            }
            if ($i > 1) {
                $query .= " AND `{$keys}` = `{$vals}` ";
            }
        }
        $rs =DB::execute($query);
        if (is_foreachable($rs)) {
            foreach ($rs as $key => $value) {
                $data[] = $value;

            } // foreach
        } // if
        return $data;
    }


}