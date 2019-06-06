<?php

use Phalcon\Mvc\Controller;

class StampsController extends Controller
{
	public function indexAction(){
        // show list of stamps
        $stamps = Stamps::find();
        $this->view->stamps = $stamps;
    }

    public function newAction(){
        
    }

    public function submitAction(){
        // get variables from the form
		$name = $this->request->get('name');
		$year = $this->request->get('year');
		$collection = $this->request->get('collection');
		$size = $this->request->get('size');
		$quantity = $this->request->get('quantity');
		$picture = $this->request->get('picture');
		$description = $this->request->get('description');
		$glued = $this->request->get('glue');

		// create a random filename
		$ext = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));
		$picture = md5(rand() . $_FILES["picture"]["name"]).".".$ext;

		// copy the picture to the images directory
		copy($_FILES["picture"]["tmp_name"], "images/$picture");

		// add a new stamp to the database
		$stamp = new Stamps();
        $stamp->name = $name;
		$stamp->yearissued = $year;
		$stamp->collection = $collection;
		$stamp->size = $size;
		$stamp->quantity = $quantity;
		$stamp->picture = $picture;
        $stamp->description = $description;
        $stamp->glued = empty($glued) ? 0 : 1;
        $stamp->save();

        // redirect
        $this->response->redirect('/stamps');
    }

    public function deleteAction(){
        // get the ID of the stamp to delete
		$id = $this->request->get('id');

		// delete stamp from the database
		$stamp = Stamps::findFirst($id);
        $stamp->delete();
        
        // redirect to the list of stamps
		$this->response->redirect('stamps');
    }

    public function updateAction(){
        // get ID of stamp to edit
        $id = $this->request->get('id');
    
        $stamp = Stamps::findFirst($id);

        $this->view->stamp = $stamp;
    }

    public function updatesubmitAction()
    {
        // get variables from the form
        $id = $this->request->get('id');
		$name = $this->request->get('name');
		$year = $this->request->get('year');
		$collection = $this->request->get('collection');
		$size = $this->request->get('size');
		$quantity = $this->request->get('quantity');
		$description = $this->request->get('description');
        $glued = $this->request->get('glue');
        
        // upload pic
        $picture = "TODO";

        // add updated information to database and save
        $stamp = Stamps::findFirst($id);
        $stamp->name = $name;
		$stamp->yearissued = $year;
		$stamp->collection = $collection;
		$stamp->size = $size;
		$stamp->quantity = $quantity;
		$stamp->picture = $picture;
        $stamp->description = $description;
        $stamp->glued = empty($glued) ? 0 : 1;
        $stamp->save();

        // redirect
        $this->response->redirect('/stamps');
    }
}