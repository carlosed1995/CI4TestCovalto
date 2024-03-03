<?php

namespace App\Controllers;
use App\Libraries\MarvelServiceWrapper;
use App\Models\CharactersModel;

class Marvel extends BaseController
{
    protected $serviceMarvel;
    
    public function __construct(){
        $this->serviceMarvel = new MarvelServiceWrapper();
    }

    /**
     * Displays the list of characters and creates new characters from the API if no data exists.
     *  
     */

    public function index(): string
    {  
		   $charactersModel = new CharactersModel();
		   $existingCharacters = $charactersModel->findAll();
	   
		   if (empty($existingCharacters)) {
			   $characters = $this->serviceMarvel->listCharacters(); 
	    
			   foreach ($characters as $character) { 
				   $charactersModel->insert($character);
			   }  
		   }  
 
           $data = [
            'characters' => $charactersModel->paginate(10),  
            'pager' => $charactersModel->pager 
        ];
    
		   return view('marvel_index', $data);
   
    }

    /**
     * Displays the form for creating a new character.
     *  
     */

	 public function new()
	 { 
		 return view('marvel_create');
	 }

    /**
     * Created character in the database.
     *  
     */

	 public function create()
	 {  
		 $rules = [
			 'name' => 'required|is_unique[characters.name]',   
			 'file' => [ 	'uploaded[file]',
				'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
				'max_size[file,4096]',
			],
				
			 'description' => 'required'
		 ];
		 
		 $post = $this->request->getPost(['name', 'file', 'description']);

		 if (!$this->validate($rules)) {
			return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
		}

        $path = FCPATH . 'public/charactersImg';
		$image = $this->request->getFile('file'); 
		$image->move($path); 

		$characterModel = new CharactersModel();
		$characterModel->insert([
          'name' => trim($post['name']),
          'thumbnail'  => $image->getClientName(),
          'description' => $post['description']
		 ]);
		 return redirect()->to('/')->with('success', 'Success create new character');  
	 }

   /**
     * Displays the form for editing the specified character.
     *  
     */

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->route('/');
        }

        $character = new CharactersModel(); 
        $data['character'] = $character->find($id);
        return view('marvel_edit', $data);
    }

	/**
     * Updates the specified character in the database.
     *  
     */

	public function update($id = null)
    {
        if (!$this->request->is('put') || $id == null) {
            return redirect()->route('/');
        }
 
		$rules = [
			'name' => "required|is_unique[characters.name,id,{$id}]",
			'description' => "required"
		];  

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['name', 'description']);

        $charactersModel = new CharactersModel();
        $charactersModel->update($id, [
            'name'            => trim($post['name']),
            'description'           => trim($post['description']), 
        ]);
		return redirect()->to('/')->with('success', 'Success edit character'); 
    }

    /**
     * Deletes the specified character from the database.
     *  
     */

	public function delete($id = null)
    {
        if (!$this->request->is('delete') || $id == null) {
            return redirect()->route('marvel');
        }

        $charactersModel = new CharactersModel();
        $charactersModel->delete($id);

		return redirect()->to('/')->with('success', 'Success delete character');
    } 
}
