<?php
include "include.php";
if ($_POST['getcomments']) {
    $pid = $_POST['id'];
    // echo $pid;
    class Comment
    {
        var $id;
        var $uid;
        var $content;
        var $cdate;
        var $nbrReplies;
        var $usrName;
        var $usrImg;
        var $replies;
        public function setCmt($id, $content, $cdate, $nbrReplies, $usrName, $usrImg)
        {
            $this->id = $id;
            $this->content = $content;
            $this->cdate = $cdate;
            $this->nbrReplies = $nbrReplies;
            $this->usrName = $usrName;
            $this->usrImg = $usrImg;
        }
    }
    class reply
    {
        var $rid;
        var $cid;
        var $content;
        var $rdate;
        var $usrName;
        var $usrImg;
        public function setreply($rid, $content, $cid, $rusrName, $rusrImg, $rdate)
        {
            $this->rid = $rid;
            $this->content = $content;
            $this->cid = $cid;
            $this->usrName = $rusrName;
            $this->usrImg = $rusrImg;
            $this->rdate = $rdate;
        }
    }

    // global variable
    $Allcomments = array();
    $Allreplies = array();

    // get cmt 
    $slcomment = mysqli_query($dbc, "SELECT  `commentid`, `content`, `userid`, `commentdate` FROM `comment` WHERE `productid`='$pid'");
    while ($data = mysqli_fetch_array($slcomment)) {
        $cid = $data['commentid'];
        $content = $data['content'];
        $uid = $data['userid'];
        $commentdate = $data['commentdate'];
        $sluser = mysqli_query($dbc, "SELECT  `username`, `userimg` FROM `user` WHERE `userid`='$uid'");
        $user_info = mysqli_fetch_array($sluser);
        $username = $user_info['username'];
        $userimg = $user_info['userimg'];
        $slrply = mysqli_query($dbc, "SELECT `replyid` FROM `reply` WHERE `commentid`='$cid'");
        $reply_num = mysqli_num_rows($slrply);
        $cmt = new Comment;
        $cmt->setCmt($cid, $content, $commentdate, $reply_num, $username, $userimg);

        // get cmt replies
        $commentReplies = mysqli_query($dbc, "SELECT `replyid`, `content`, `commentid`, `userid`, `replydate` FROM `reply` WHERE `commentid`='$cid'");
        while ($rep = mysqli_fetch_array($commentReplies)) {
            $replyid = $rep['replyid'];
            $content = $rep['content'];
            $commentid = $rep['commentid'];
            $userid = $rep['userid'];
            $sluser = mysqli_query($dbc, "SELECT  `username`, `userimg` FROM `user` WHERE `userid`='$userid'");
            $user_info = mysqli_fetch_array($sluser);
            $rusername = $user_info['username'];
            $ruserimg = $user_info['userimg'];
            $replydate = $rep['replydate'];
            $repl = new Reply;
            $repl->setreply($replyid, $content, $commentid, $rusername, $ruserimg, $replydate);
            array_push($Allreplies, $repl);
        }
        $cmt->replies = $Allreplies;
        $Allreplies = [];
        array_push($Allcomments, $cmt);
    }
    ;
    echo json_encode($Allcomments);
}
?>