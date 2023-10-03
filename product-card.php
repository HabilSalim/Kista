<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
  <title>Product Card</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>
  <?php
  include "navbar.php";
  include "apps/include.php";
  if (isset($_SESSION['userid'])) {
    echo '<div class="text-end mt-3"><a href="ux.php"<button class="btn btn-info text-white mb-1" >Dashboard</button></a></div>';
  }
  ?>

  <!-- reply form -->
  <div id="replyFrmDiv" style="display:none">
    <div class="mb-2 mt-1"><b>Comment: </b> <i id="commentContent"></i></div>
    <form id="replyform">
      <textarea id="replyContent" class="form-control" placeholder="Text..." cols="5" rows="5"></textarea>
      <input type="hidden" id="replyCmtId">

      <div class="btn btn-danger mt-3 mb-3 cansel-reply">Cancel</div>
      <button class="btn btn-primary mt-3 mb-3 send-reply" name="reply-form-btn" type="submit">Send</button>
    </form>
  </div>
  <?php

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $qry = mysqli_query($dbc, "SELECT `productid`, `userid`, `productname`, `productimg`, `productquantity`, `productprice`, `productdate` FROM `product` WHERE `productid`='$id'");
    $data = mysqli_fetch_array($qry);

    $comqry = mysqli_query($dbc, "SELECT `commentid` FROM `comment` WHERE `productid`='$id'");
    if (mysqli_num_rows($comqry) == NULL) {
      $comment_num = 0;
    } else {
      $comment_num = mysqli_num_rows($comqry);
    }
    ?>
    <!-- Product -->
    <div class="container mt-5">
      <div class=" mx-auto" style="width: 27rem;">
        <div class="card">
          <img src="<?php echo $data['productimg']; ?>" class="card-img-top w-100"
            alt="<?php echo $data['productname']; ?>">
          <div class="card-body">
            <h5 class="card-title">
              <?php echo $data['productname']; ?>
            </h5>
            <p class="card-text">
              <?php echo $data['productprice']; ?> FCFA
            </p>
            <p class="card-text">
              <?php echo $data['productquantity']; ?> Units
            </p>
            <div class="row">
              <div class="col-7">
                <?php
                $uss1 = $data['userid'];
                $usid = mysqli_fetch_array(mysqli_query($dbc, "SELECT  `username` FROM `user` WHERE `userid`='$uss1'"));
                echo "By " . $usid['username']; ?>
              </div>
              <div class="col-5 text-end">
                <?php echo $data['productdate']; ?>
              </div>
            </div>
            <div class="comments btn btn-outline-primary mt-3 mb-2">
              <?php echo $comment_num ?> comments
            </div>
          </div>
        </div>
        <!-- Comment form -->
        <form id="commentForm">
          <div class="comments-section mt-3" style="display: none;">
            <textarea id="comment-content-textarea" name="comment" class="form-control" placeholder="Text..." cols="20"
              rows="10"></textarea>
            <input type="hidden" id="comment-productid" name="product" value="">
            <div class="btn btn-danger mt-2 mb-3 cansel-comment">Cancel</div>
            <button class="btn btn-primary mt-2 mb-3 send-comment" type="submit">Send</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Comments -->
    <div class="container mt-5">
      <div class="mt-5">
        <h1 class="Underline">Comments</h1><br>
        <div id="all_comments">




        </div>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        <?php echo 'var productid="' . $id . '";'; ?>

        // Reply form dialog
        $('#replyFrmDiv').dialog({
          width: 400,
          title: 'Add a reply',
          autoOpen: false,
          modal: true,
          draggable: false,
          open: function (event, ui) {
            $(event.target).dialog('widget')
              .css({ position: 'fixed' })
              .position({ my: 'center', at: 'center', of: window });
          },
          resizable: false
        });

        getCmts(productid);
        // Get comment function
        function getCmts(id) {
          $.ajax({
            'url': 'apps/backend.php',
            'type': 'post',
            data: { id: id, getcomments: 'ok' },
            success: function (e) {
              var res = JSON.parse(e);
              displaycmnt(res);
            }
          })
        };
        // End of get comments


        // Comment function
        function displaycmnt(cmt) {
          for (i = 0; i < cmt.length; i++) {
            var onerpl;
            var allrpl = '<div class="replyDiv" id="replyDiv' + cmt[i].id + '" style="display:none;"><button class="replies my-3 btn btn-outline-primary replyBtn" data-cid="' + cmt[i].id + '" data-content="' + cmt[i].content + '">Reply</button>';
            for (j = 0; j < cmt[i].replies.length; j++) {
              onerpl = ' <div class="comment border p-3 rounded ">' +
                '<div class="comment-img">' +
                '<img src="' + cmt[i].replies[j].usrImg + '" alt="' + cmt[i].replies[j].usrName + '">' +
                '</div>' +
                '<div class="comment-content">' +
                '<p>' + cmt[i].replies[j].usrName + '</p>' +
                '<div class="row mt-3"><div class="col-8 col-md-9">' +
                '<p class="mb-5">' + cmt[i].replies[j].content + '</p>' +
                '</div><div class="col-4 col-md-3 text-end"><p class="comment-date">'
                + cmt[i].replies[j].rdate +
                '</p></div></div></div></div>';
              allrpl = allrpl + onerpl;
            };
            var oneCmt = ' <div class="border p-3 mb-4 rounded"><div class="comment  ">' +
              '<div class="comment-img">' +
              '<img src="' + cmt[i].usrImg + '" alt="' + cmt[i].usrName + '">' +
              '</div>' +
              '<div class="comment-content">' +
              '<p>' + cmt[i].usrName + '</p>' +
              '<p class="mb-5">' + cmt[i].content + '</p>' +
              '<div class="row mt-3"><div class="col-6">' +
              '<button class="replies btn btn-outline-primary viewRepliesBtn" data-cmtid="' + cmt[i].id + '">' + cmt[i].nbrReplies + ' replies </button>' +
              '</div><div class="col-6"><p class="comment-date">'
              + cmt[i].cdate +
              '</p></div></div></div></div><div class="col-11 mx-auto rounded mt-3"style="max-height:50vh;overflow:auto;"id="reply' + cmt[i].id + '">' + allrpl + '</div></div></div>';
            $("#all_comments").append(oneCmt);
          }
        }

        // Show and hide dialog
        $('#all_comments').on('click', '.replyBtn', function () {
          var cid = $(this).attr('data-cid');
          var content = $(this).attr('data-content');
          $('#replyCmtId').val(cid);
          $('#commentContent').text(content);
          $('#comment-content-textarea').text('');
          $('#replyFrmDiv').dialog('open');
        });
        $(".cansel-reply").click(function () {
          $('#replyFrmDiv').dialog('close');
        })

        // Submit commnet form
        $('#commentForm').submit(function (e) {
          e.preventDefault();
          var cid = $('#comment-productid').val();
          var commentContent = $('#comment-content-textarea').val();
          var url = 'apps/process.php';
          $.ajax({
            url: url,
            type: 'post',
            data: { cid: cid, commentcontent: commentContent, productid: productid, submitcomment: 'ok' },
            success: function (e) {
              var res = JSON.parse(e);
              if (res == 'succeed') {
                window.location.reload();
              } else {
                alert('Sorry! You must sign in to comment.');
                $(".comments-section").hide("slow");
                $("#comment-content-textarea").text("");
              }
            }
          });
        });


        // Submit reply form
        $('#replyform').submit(function (e) {
          e.preventDefault();
          var cid = $('#replyCmtId').val();
          var replyContent = $('#replyContent').val();
          var url = 'apps/process.php';
          $('#replyFrmDiv').dialog('close');
          $.ajax({
            url: url,
            type: 'post',
            data: { cid: cid, content: replyContent, productid: productid, submitCmtReply: 'ok' },
            success: function (e) {
              var res = JSON.parse(e);
              if (res == 'succeed') {
                window.location.reload();
              } else {
                alert('Sorry! You must sign in to reply a comment.');
                $("#replyContent").text("");
              }
            }
          });
        });


        //View replies code
        $('#all_comments').on('click', '.viewRepliesBtn', function () {
          var cmtID = $(this).attr('data-cmtid');
          $(".replyDiv").hide();
          $('#replyDiv' + cmtID).fadeToggle();
        });


        // Comment form show and hide
        $(".comments").click(function () {
          $(".comments-section").show("slow");
          $(".replies-section").hide("slow"); // Hide replies section when showing comments section
          $('#comment-productid').val(productid);
        });


        $(".cansel-comment").click(function () {
          $(".comments-section").hide("slow");
          $(".comments-section input").val("");
          $(".comments-section textarea").text("");
        });

      });
    </script>
    <?php
  }
  ?>
  <!-- comment section starts -->
  <style>
    .comment {
      display: flex;
      margin-bottom: 20px;
    }

    .comment-img {
      flex: 0 0 50px;
      margin-right: 10px;
    }

    .comment-img img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;

    }

    .comment-content {
      flex: 1;
    }

    .comment-name {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .comment-date {
      font-size: 16px;
      color: #141212;
      text-align: right;
    }

    .Underline {
      text-decoration: underline;
      text-declaration-color: blue;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.js">
</body>

</html>