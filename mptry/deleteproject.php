<?php
    function Delete($path){
        if (is_dir($path) === true)
        {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);

            foreach ($files as $file)
            {
                if (in_array($file->getBasename(), array('.', '..')) !== true)
                {
                    if ($file->isDir() === true)
                    {
                        rmdir($file->getPathName());
                    }

                    else if (($file->isFile() === true) || ($file->isLink() === true))
                    {
                        unlink($file->getPathname());
                    }
                }
            }

            return rmdir($path);
        }

        else if ((is_file($path) === true) || (is_link($path) === true))
        {
            return unlink($path);
        }

        return false;
    }
    if(isset($_GET['db'])){
        $db=$_GET['db'];
        if(!empty($db)){
            if(Delete('./basefiles/'.$db)){
                require 'sqlcon.php';
                $query='DROP DATABASE '.$db.'';
                $query_run=mysql_query($query);
                if($query_run){
                    mysql_select_db('projects');
                    $query="DELETE FROM `projects` WHERE `name`='$db'";
                    $query_run=mysql_query($query);
                    if($query_run)
                        echo "Deleted!";
                }
            }
        }
    }
?>