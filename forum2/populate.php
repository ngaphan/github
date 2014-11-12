<?php
    $sIpAddress = $_SERVER['REMOTE_ADDR'];

    if ('127.0.0.1' === $sIpAddress) {
        require 'inc/config.inc.php';

        $sMode = array_key_exists('mode', $_GET) ? $_GET['mode'] : false;

        switch ($sMode) {
            case 'topic':
                $aCategories = getCategories();
                foreach ($aCategories as $aCategory) {
                    createTopic('my subject', $aCategory['id'], 'yoann');
                }
                break;
            case 'reply':
                $aCategories = getCategories();
                $aTopics = getTopicsFromCategory($aCategories[0]['id']);

                $aMessages = array('salut', 'ça va ?', 'comment va ?', 'hello', 'hep', 'hey', 'yo!', 'coucou');
                $aUsers = array('yoann', 'florian');

                foreach ($aTopics as $aTopic) {
                    for ($iPosition = 1; $iPosition <= 5; $iPosition++) {
                        createReply($aMessages[array_rand($aMessages)], $aTopic['id'], $aUsers[array_rand($aUsers)]);
                    }
                }
                break;
            default:
                break;
        }


    } else {
        header('location:index.php');
    }