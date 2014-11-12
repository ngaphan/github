<?php

    /**
     * Get all categories.
     *
     * @return array all categories.
     */
    function getCategories()
    {
        $oDataBase = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        mysqli_set_charset($oDataBase, 'utf8');

        $sQuery = 'select * from category';
        $oResult = mysqli_query($oDataBase, $sQuery);
        if (false !== $oResult) {
            $aCategories = array();
            do {
                $aCategory = mysqli_fetch_assoc($oResult);
                if (null !== $aCategory) {
                    $aCategories[] = $aCategory;
                }
            } while (null !== $aCategory);
            mysqli_free_result($oResult);
        } else {
            echo 'Query error : ' . mysqli_error($oDataBase);
            echo '<br />' . $sQuery;
        }

        mysqli_close($oDataBase);

        return $aCategories;
    }

    /**
     * Get a category from its id.
     *
     * @param integer $iCategoryId category id.
     *
     * @return array matched category.
     */
    function getCategoryFromId($iCategoryId)
    {
        $oDataBase = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        mysqli_set_charset($oDataBase, 'utf8');

        $sQuery = "select * from category where id = '$iCategoryId' limit 1";
        $oResult = mysqli_query($oDataBase, $sQuery);

        $aCategory = mysqli_fetch_assoc($oResult);
        mysqli_free_result($oResult);

        mysqli_close($oDataBase);

        return $aCategory;
    }

    /**
     * Get a topic from its id.
     *
     * @param integer $iTopicId topic id.
     *
     * @return array matched topic.
     */
    function getTopicFromId($iTopicId)
    {
        $oDataBase = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        mysqli_set_charset($oDataBase, 'utf8');

        $sQuery = "select t.*, c.name as category from topic t, category c where t.id = '$iTopicId' and t.category = c.id limit 1";
        $oResult = mysqli_query($oDataBase, $sQuery);

        $aCategory = mysqli_fetch_assoc($oResult);
        mysqli_free_result($oResult);

        mysqli_close($oDataBase);

        return $aCategory;
    }


    /**
     * Get all topics inside the given category.
     *
     * @param integer $iCategoryId category id.
     *
     * @return array topics from the category.
     */
    function getTopicsFromCategory($iCategoryId)
    {
        $oDataBase = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        mysqli_set_charset($oDataBase, 'utf8');

        $sQuery = "select t.*, count(r.id) as total";
        $sQuery .= " from topic t left outer join reply r on t.id = r.topic";
        $sQuery .= " where t.category = '$iCategoryId'";
        $sQuery .= " group by t.id";
        $sQuery .= " order by t.date desc";
        $oResult = mysqli_query($oDataBase, $sQuery);

        $aTopics = array();
        do {
            $aTopic = mysqli_fetch_assoc($oResult);
            if (null !== $aTopic) {
                $aTopics[] = $aTopic;
            }
        } while (null !== $aTopic);
        mysqli_free_result($oResult);

        mysqli_close($oDataBase);
        return $aTopics;
    }


    /**
     * Get all replies from the given topic.
     *
     * @param integer $iTopicId topic id.
     *
     * @return array replies from the topic.
     */
    function getRepliesFromTopic($iTopicId)
    {
        $oDataBase = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        mysqli_set_charset($oDataBase, 'utf8');

        $sQuery = "select * from reply where topic = '$iTopicId' order by date asc";
        $oResult = mysqli_query($oDataBase, $sQuery);

        $aReplies = array();
        do {
            $aReply = mysqli_fetch_assoc($oResult);
            if (null !== $aReply) {
                $aReplies[] = $aReply;
            }
        } while (null !== $aReply);
        mysqli_free_result($oResult);

        mysqli_close($oDataBase);

        return $aReplies;
    }

    /**
     * Create a new topic.
     *
     * @param string  $sSubject    subject.
     * @param integer $iCategoryId category id.
     * @param string  $sUser       user name.
     *
     * @return bool true if success, false otherwise.
     */
    function createTopic($sSubject, $iCategoryId, $sUser)
    {
        $oDataBase = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        mysqli_set_charset($oDataBase, 'utf8');

        $dDate = date('Y-m-d H:m:s');
        $sSubject = addslashes($sSubject);
        $sUser = addslashes($sUser);

        $sQuery = "insert into topic (subject, date, category, user) values('$sSubject','$dDate', '$iCategoryId', '$sUser')";
        $oResult = mysqli_query($oDataBase, $sQuery);

        $bResult = true;
        if (false === $oResult) {
            echo 'something went wrong in the query : ' . $sQuery . '<br />';
            echo mysqli_error($oDataBase);
            $bResult = false;
        }
        mysqli_close($oDataBase);
        return $bResult;
    }


    /**
     * Create a reply.
     *
     * @param string  $sContent content.
     * @param integer $iTopicId topic id.
     * @param string  $sUser    user name.
     *
     * @return bool true if success, false otherwise.
     */
    function createReply($sContent, $iTopicId, $sUser)
    {
        $oDataBase = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        mysqli_set_charset($oDataBase, 'utf8');

        $dDate = date('Y-m-d H:m:s');
        $sContent = addslashes($sContent);
        $sUser = addslashes($sUser);

        $sQuery = "insert into reply (content, date, topic, user) values('$sContent','$dDate', '$iTopicId', '$sUser')";
        $oResult = mysqli_query($oDataBase, $sQuery);

        $bResult = true;
        if (false === $oResult) {
            echo 'something went wrong in the query : ' . $sQuery . '<br />';
            echo mysqli_error($oDataBase);
            $bResult = false;
        }
        mysqli_close($oDataBase);
        return $bResult;
    }

    /**
     * Format a date.
     *
     * @param date $dDate date
     *
     * @return string formatted date.
     */
    function formatDate($dDate)
    {
        return date_format(date_create($dDate), 'd F Y');
    }

    /**
     * Format a datetime.
     *
     * @param date $dDateTime datetime.
     *
     * @return string formatted datetime.
     */
    function formatDateTime($dDateTime)
    {
        return date_format(date_create($dDateTime), 'd F Y - H:i:s');
    }

    function getLogin()
    {
        if (array_key_exists('login', $_SESSION) && '' !== $_SESSION['login']) {
            return $_SESSION['login'];
        } else {
            return false;
        }
    }

    /**
     * Connect a user.
     *
     * @param string $sUser     user.
     * @param string $sPassword password.
     *
     * @return bool true if success, false otherwise
     */
    function connectUser($sUser, $sPassword)
    {
        $oDataBase = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
        mysqli_set_charset($oDataBase, 'utf8');

        // crypt password
        $sPassword = sha1($sPassword);

        $sQuery = "select login from user where login = '$sUser' and password = '$sPassword' limit 1";
        $oResult = mysqli_query($oDataBase, $sQuery);

        $aUser = mysqli_fetch_assoc($oResult);
        mysqli_free_result($oResult);

        mysqli_close($oDataBase);

        if (null === $aUser) {
            return false;
        }

        $_SESSION['login'] = $aUser['login'];
        return true;
    }