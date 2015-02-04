<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Controller_Test extends Controller_Rest {
//    public function action_list() { 
//        
//        $postParam = !empty(Input::put('post_param', '')) ? Input::put('post_param', '') : null;
//        
//        return $this->response(array(
//            'post_param' => $postParam,
//            'foo' => Input::get('foo'),
//            'baz' => array(
//                1, 50, 219
//            ),
//            'empty' => null
//        ));
//    }

    public function before() {
        parent::before();
        
    }
    
    
    public function  get_list() {
        return $this->response(array(
            'foo' => Input::get('foo'),
            'baz' => array(
                1, 50, 219
            ),
            'empty' => null
        ));
    }
   

    public function post_add() {
       
        $_result = array();

    //マルチパートのStringパートを受信しディレクトリ名とする
         $_directoryname = Security::htmlentities(Input::post('Author'));

    //マルチパートのFileパートを受信するためにUploadクラスのコンフィグ設定
    $_config = array(
            'path' => APPPATH.'/tmp/', //ファイルの保存を許可するディレクトリを指定
            'create_path' => true, //ディレクトリが存在しなければ作成
            'auto_rename' => true, //ファイル名が重複した場合に自動でリネーム
//            'ext_whitelist' => array('json'), //拡張子xmlのみアップロードを許可
//            'mime_whitelist' => array('application/json') // mimetypeがapplication/xmlのみアップロードを許可
    );
    Upload::process($_config); //アップロード実行（コンフィグ指定が無ければ省略できる）
    $_files = Upload::get_files(); //アップロードしたファイルの情報を取り出す
    
   
    if(Upload::is_valid()){ //アップロードしたファイルの検査を行う
        //検査合格したファイルに対して実行
        foreach( $_files as $_key => $_value){
            Upload::save(APPPATH.'/fileUpload/'.$_directoryname.'/',$_key); //指定ディレクトリにファイルを保存
            $_result += array($_files[$_key]['name'] => 'Upload Successd');
        }
    }
    $_errorfiles = Upload::get_errors();  //検査不合格のファイル情報を取得
    foreach ($_errorfiles as $_key => $_value){ 
        //検査不合格だったファイルに対して実行
        foreach ($_value['errors'] as $_key => $_error){
                $_result += array($_value['name'] => $_error['error'].':'.$_error['message']);
        }
    }

    return $this->response($_result);
 
    }
    
    public function post_add1() {
        print_r(Input::post()); die;
    }
   
    public function post_list() {
//        $this->response(print_r(Input::json()));
        
        
        
  
        $post = Input::json();
        
        $glossary = Input::json('glossary', null);
        
        $title = $glossary['title'];
        
        $GlossDiv = $glossary['GlossDiv'];
        
        $GlossList = $GlossDiv['GlossList'];
        
        $GlossEntry = $GlossList['GlossEntry'];
        
        $GlossDef = $GlossEntry['GlossDef'];
        
        $GlossSeeAlso = $GlossDef['GlossSeeAlso'];
        
        //print_r($GlossSeeAlso); die;
        //"GlossSeeAlso": [{"key":"GML"}, {"key":"XML"}];
        //
       
        foreach ($GlossSeeAlso as $key => $value) {
            print_r($value);
            echo $value['key'];
        }
        die;
        print_r($glossary); die;
//        $a = !empty($post['post_param']) ? $post['post_param'] : null;
        
//        $b = Input::json('key4', 'gia tri mac dinh neu eo co');
     
        return $this->response(array(
            
//            'post_param' => $a,
//            'test' => $b
        ));
//        $this->response(print_r($_POST));
//        $postParam = !empty(Input::put('post_param', '')) ? Input::put('post_param', '') : null;
//        return $this->response(array(
//            'post_param' => $postParam)
//        );
    }
    
    
    
}