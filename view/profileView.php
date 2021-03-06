<?php include 'head.php'; ?>

    <article id="article">
       <div class="top-article">
            <?php if($list['author'] == $_SESSION['author']) { # 현제 로그인 사용자 페이지에만 버튼으로 나타남 ?>
                <a href="#open2">
            <?php } ?>
                    <img class="profile-img" src="<?= ($list['usericon']) ? htmlspecialchars($list['usericon']) : 'img/noimage.jpg'; ?>"> 
                </a><!-- 삼항 연산자 : 조건 ? true : false -->
            <div class="info">
                <div><h2><?= $list['author'] ?></h2></div>
                <!-- <div><a href="#"><img class="button" src="img/profile/profile2.png"></a></div> -->
                <?php if($list['author'] == $_SESSION['author']) { # 현제 로그인 사용자 페이지에만 버튼으로 나타남 ?>
                    <div><a href="#open1"><img class="setting" src="img/profile/profile3.png"></a></div>
                <?php } ?>
            </div>
            <div class="count">
                <div>
                    <a href="main.php?author=<?= $_SESSION['author'] ?>"><span>총 게시물 <?= $pictureCnt ?></span></a>
                </div>
                <div>
                    <a href="followerList.php?author=<?= $list['author'] ?>"><span>팔로워 <?= count($followers); ?></span></a>
                </div>
                <div>
                    <a href="followingList.php?author=<?= $list['author'] ?>"><span>팔로우 <?= count($followings); ?></span></a>
                </div>
                <div>
                    <?php if($list['author'] != $_SESSION['author']){ #현제 로그인된 사용자라면 버튼을 출력하지 않기. ?>
                        <?php $isFollowing =  true; 
                            foreach($followers as $item){ 
                                if(array_search($_SESSION['author'], $item)){ #배열안에 사용자명이 있는지. 있다면 true.
                                    $isFollowing = false;
                                    break; #사용자 명이 있으면 false 를 대입하고 빠져나옴.
                                } else {
                                    $isFollowing = true;
                                }
                            }
                            if($isFollowing){  
                        ?>
                            <form class="follow">
                                <input type="hidden" name="followUser" value="<?= $list['id']; ?>" />
                                <button class="follow-btn" formmethod="POST" name="follow" 
                                value="<?= $_SESSION['author'] ?>" formaction="followProcess.php?author=<?= $list['author'] ?>">
                                <?= $list['author'] ?> 팔로우</button>
                            </form>
                        <?php } else { ?>
                            <form class="follow">
                                <input type="hidden" name="followUser" value="<?= $list['id']; ?>" />
                                <button class="follow-btn" formmethod="POST" name="unfollow" 
                                value="<?= $_SESSION['author'] ?>" formaction="unfollowProcess.php?author=<?= $list['author'] ?>">
                                <?= $list['author'] ?> 팔로우 중</button>
                            </form>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
       </div>
        <div class="mid-article">
           <p><span><?= $list['author']; ?> 님의 게시물</span></p>
        </div>
        <div class="bottom-article">
            <?php if (!empty($pitures)) { ?>
                <?php foreach($pitures as $items){ ?>
                    <div><img src="<?= htmlspecialchars($items['src']) ?>"></div>
                <?php } ?> 
            <?php } else { ?>
                <?= "<p>업로드한 사진이 없습니다.</p>"; ?>
            <?php } ?> 
        </div>
        <div class="page">
            <nav>
                <ul>
                    <li class="page-item"><a class="page-link" href="profile.php?author=<?= $list['author'] ?>&page=1">처음으로</a></li>
                    <li class="page-item"><a class="page-link" href="profile.php?author=<?= $list['author'] ?>&page=<?= $Startpage - 1 ?>">이전</a></li>
                    <?php for ($p = $Startpage; $p <= $Endpage; $p++) { ?>
                        <li class="page-item"><a class="page-link" href="profile.php?author=<?= $list['author'] ?>&page=<?=$p?>"><?=$p?></a></li>
                    <?php } ?>
                    <?php if( $pageNum != $Endpage) { # 총 페이지 와 블럭의 마지막 값이 같지 않을 때만 '다음'버튼을 출력.(출력내용이 남아있을때) ?>
                        <li class="page-item"><a class="page-link" href="profile.php?author=<?= $list['author'] ?>&page=<?= $Endpage + 1 ?>">다음</a></li>
                        <li class="page-item"><a class="page-link" href="profile.php?author=<?= $list['author'] ?>&page=<?= $pageNum ?>">끝으로</a></li>
                    <?php } ?>
                </ul>
            </nav>
            <p class="is-page">-<?= $page ?> 페이지-</p>
        </div>
    </article>
    
<?php include 'profileViewModal.php'; ?>     
<?php include 'footer.php'; ?>