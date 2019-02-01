<?php

namespace Phalcon;


use Baka\Feeds\Exception\InvalidArgumentException;


/**
 * \Phalcon\comments
 *
 * Class for the feeds module component.
 *
 * @package Phalcon
 */
class Comment extends Feeds
{


    /**
     * Feeds constructor.
     */
    public function __construct()
    {

    }


    /**
     *
     * Generate comments reply
     *
     * @param string $comm_id reaction item identifier.
     *
     * @return \Response
     */
    public function generateReplies(
        $comm_id
    )
    {
        $html = "";
        $comments = $this->getReplies($comm_id, $limit);
        // we generate the output of the comments
        if($comments)
            foreach ($comments as $comment) {
                if(!($name = $this->getUsername($comment->name)))
                    $name = $comment->name;
                // show normal username or with adminStyles
                $style ="";
                $show_name = $this->html($name);
                // show extra info only to admin
                $show_extra ="";
                if($this->settings['isAdmin']) {
                    $browser = explode(" ", $comment->browser);
                    $show_extra = "($comment->email | ".$browser[0]." | $comment->ip)";
                }
                $is_del = (isset($_GET['comm_del']) && ($_GET['comm_del'] === $comment->id) && $this->hasRights($comment))
                    ? " background-color: #FFDE89; border: 1px solid red;" : null;
                $html .= "
			<div class='media' id='$comment->id' style='". $style. $is_del ."'>
				<a class='pull-left' href='http://gravatar.com'>
				<img class='media-object' src='http://gravatar.com/avatar/".md5($comment->email)."'>
				</a>	
				<div class='media-body'>";

                if(isset($_GET['comm_edit']) && ($_GET['comm_edit'] === $comment->id) && $this->hasRights($comment))
                    // we generate the form in edit mode with precompleted data
                    $html .= $this->generateForm('', 2, $comment);
                else
                    $html .= "<h4 class='media-heading'>
						$show_name $show_extra
						<small class='muted'>".$this->tsince($comment->time)." replied </small>
						".$this->admin_options($comment)."
					</h4>
					<p>".nl2br($this->html($comment->message))."</p>";

                if($is_del)
                    $html .= $this->gennerateConfirm('', 'comm_del', $comment->id);
                $html .= "</div></div>";
            }
        return $html;
    }

    /**
     * gets the replies to a certain comment
     * @param  integer $comm_id the id for the specific comment
     * @param  integer $limit max number of comments to be displayed as reply
     * @return array		  the comments
     */
    function getReplies($comm_id = 0, $limit = 3) {
        $comments = array();
        $sql = "SELECT * FROM `".$this->settings['comments_table']."` 
			WHERE `parent` = '".mysqli_real_escape_string($this->link, $comm_id)."'";
        // limitation
        $sql .= "LIMIT 0, $limit";
        if($result = mysqli_query($this->link, $sql))
            while($row = mysqli_fetch_object($result))
                $comments[] = $row;
        else
            return false;
        return $comments;
    }







}
