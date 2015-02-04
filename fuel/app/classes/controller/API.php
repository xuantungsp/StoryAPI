<?php

use Model_Story as Story;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define('ERR_CODE_SUCCESS', 200);
define('ERR_CODE_DEFAULT', 400);

define('ERR_MSG_DEFAULT', 'System Error');

class Controller_API extends Controller_Rest {
    
    
    public function  get_listStory() {             
        
        $entry = Model_Story::find('all');
        return $this->response($this->successData($entry));
    }
    
    public function get_listChapInStory() {
        $storyId = Input::get('story_id');
        
//        Model_Chap::query()->related('Story', array(
//            'where' => array(
//                'id', '=', $storyId,
//            ),
//        ));

        $entry = Model_Chap::find('all', array(
            'where' => array(
                array('story_id' => $storyId)
            ),
        ));        
     
        return $this->response($this->successData($entry));
    }
    
    public function get_ChapDetail() {
//        $storyId = Input::get('story_id');
        $chapId = Input::get('chap_id');
        
        $detail = Model_Chap::find('all', array(
            'where' => array(
                array('id' => $chapId),
            )
        ));
       
        return $this->response($this->successData($detail));
    }
   
    public function post_createStory() {
        $title = Input::post('title','story');
        
        $newStory = new Model_Story();
        $newStory->title = $title;
        $value = $newStory->save();
        
        return $this->response($this->successData($value));
    }
    
    public  function post_createChapInStory() {
        $storyId = Input::post('story_id');
        $chapTitle = Input::post('title');
        $chapContent = Input::post('content');        
        
        if ($storyId == null) {
            return $this->failData(ERR_CODE_DEFAULT, ERR_MSG_DEFAULT);        
        }
        
        if ($chapContent == null) {
            return $this->failData(ERR_CODE_DEFAULT, ERR_MSG_DEFAULT);
        }
        
        if ($chapTitle == null) {
            return $this->failData(ERR_CODE_DEFAULT, ERR_MSG_DEFAULT);
        }
        
        $newChap = new Model_Chap();
        $newChap->story_id = $storyId;
        $newChap->title = $chapTitle;
        $newChap->content = $chapContent;   
        $value = $newChap->save();
        
        return $this->response($this->successData($value));
    }   
    
    public function post_editStory(){
        $storyId = Input::post('story_id');
        $title = Input::post('title');
        
        if (empty($storyId) || empty($title)) {
            return $this->failData(ERR_CODE_DEFAULT, 'storyId or title is not empty');
        }
        
        $story = Model_Story::find($storyId);
        
        if ($story == null) {
            return $this->failData(ERR_CODE_DEFAULT, 'Story is not exist');
        } else {     
            
            $story->set(array(
                'title' => $title,
            ));
            $story->save();
            return $this->successData(true);
        }
    }
    
    public function post_editChap(){
//        $storyId = Input::post('story_id');
        $chapId = Input::post('chap_id');
        $title = Input::post('title');
        $content = Input::post('content');
        
        if (empty($chapId) || empty($title) || empty($content)) {
            return $this->failData(ERR_CODE_DEFAULT, 'storyId, chapId, title, content is empty');
        }
        
        $chap = Model_Chap::find($chapId);
        if ($chap == null) {
            return $this->failData(ERR_CODE_DEFAULT, 'Chap is not exist');
        } else {
            $chap->set(array(
                'title' => $title,
                'content' => $content,
            ));            
            $chap->save();
            return $this->successData(true);
        }
    }
    
    public function post_deleteStory() {
        $storyId = Input::post('story_id');
        
        $story = Model_Story::find($storyId);
        
        if ($story == null) {
            return $this->failData(ERR_CODE_DEFAULT, 'story is not exist');
        } else {
            $story->delete();
            return $this->successData(true);
        }
    }
    
    public function post_deleteChap() {
        $chapId = Input::post('chap_id');
//        $storyId = Input::post('story_id');
        
        $chap = Model_Chap::find($chapId);
        
        if ($chap == null) {
            return $this->failData(ERR_CODE_DEFAULT, 'Chap is not exist');
        } else {
            $chap->delete();
            return $this->successData(true);
        }
    }

    private function successData($data) {        
        if (is_array($data)) {            
           return array(
               'status' => '200',
               'message' => 'successs',
               'data' => array_values($data),
           );        
        } else {
           return array(
               'status' => '200',
               'message' => 'successs',               
           );            
        }
    }
    
    private function failData($status, $message) {
        return array(
            'status' => $status,
            'message' => $message,            
        );
    }
}