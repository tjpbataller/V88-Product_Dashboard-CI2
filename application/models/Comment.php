<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Model
{
    public function show_all_comments($review_id, $product_id)
    {


        $comments = "";
        $query = "SELECT users.first_name, users.last_name, comments.description, comments.created_at FROM comments INNER JOIN reviews ON comments.review_id = reviews.id INNER JOIN users ON comments.user_id = users.id WHERE product_id = ? AND comments.review_id = ?";
        $data = array(
            "product_id" => $product_id,
            "review_id" => $review_id
        );
        $results = $this->db->query($query, $data)->result_array();
        foreach($results as $result)
        {
            $post_date = human_to_unix($result["created_at"]);
            $now = now();
            $timespan = timespan($post_date, $now, 1);

            if(strpos($timespan, "Days") !== FALSE)
            {
                $date = $timespan." ago";
            }
            else
            {
                $mdate = nice_date($result["created_at"]);
                $date = mdate("%F %j%S %Y", $mdate);
            }

            $comments .= '<h5 class="w-50">'.$result["first_name"]." ".$result["last_name"].' Wrote:</h5><p class="w-25 ms-auto text-end">'.$date.'</p><p class="border border-dark comment me-0">'.$result["description"].'</p>';
        }
        return $comments;
    }

    public function create_comment($review_id, $description)
    {
        $user_id = $this->session->userdata("user_id");
        $query = "INSERT INTO comments(user_id, review_id, description, created_at, updated_at) VALUES(?,?,?,NOW(),NOW())";
        $values = array(
            "user_id" => $user_id,
            "review_id" => $review_id,
            "description" => $description
        );
        return $this->db->query($query, $values);
    }
}
?>