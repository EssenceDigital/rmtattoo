<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;

/** 
 * Handles all generic user related actions.
*/
class UsersController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    // Fields and their respective validation rules
    private $validationFields = [
        'name' => 'required|string|max:30',
        'email' => 'required|string|email|max:50|unique:users',
        'role' => 'required|string|max:10',
        'password' => 'required|string|min:6|confirmed',
        'is_artist' => 'required|boolean'
    ];

    /**
     * Validates request data and then adds it to a model. Helper method used by store() and update()
     *
     * @param  \Illuminate\Http\Request $request     
     * @return App\Model
     */
    private function validateUser(Request $request, User $user)
    {

        // Ends up looking like this->validationFields
        $fields = [];
        // Populate rules[], but skip the password field
        foreach($this->validationFields as $key => $val){
            // If it's an edit then skip the password field
            if($user->id && $key == 'password') continue;
            // Populate array for validation
            $fields[$key] = $val;
            // Append the id to the email field to ensure 'unique' validator works properly for an update
            if($user->id && $key == 'email') $fields[$key] =  $fields[$key] . ',id,' . $user->id;
        }
       
        // Validate or stop proccessing
        $this->validate($request, $fields);

        // Add request data to model
        foreach($this->validationFields as $key => $val){
            // If it's an edit then skip the password field
            if($user->id && $key == 'password'){
                continue;
            }
            // Bcrypt if it's the password field 
            if($key == 'password'){
                $user->password = bcrypt($val);
            } else {
                // Add regular fields to model
                $user->$key = $request->$key;
            }
            
        }

        return $user;
    }

    /**
     * Find all users.
     *
     * @return JSON response
     */
    public function all()
    {
        // For ACL, only allows supplied roles to access this method
        $this->authorizeRoles(['admin']);
        // Fetch users
        return User::all();       
    }

    /**
     * Get all users that are also artists.
     *
     * @return JSON Response
    */      
    public function artists()
    {
        return User::where('is_artist', '=', 1)->get();
    }

    /**
     * Find a single user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function single($id)
    {
        // For ACL, only allows supplied roles to access this method
        $this->authorizeRoles(['admin']);

        // Fetch user
        $user = User::find($id);

        // Return response for ajax call
        return response()->json([
            'result' => 'success',
            'payload' => $user
        ], 200);        
    }

    /**
     * Save a user to db
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON response
     */
    public function create(Request $request)
    {
        // For ACL, only allows supplied roles to access this method
        $this->authorizeRoles(['admin']);

        // Validate and populate the request
        $user = $this->validateUser($request, new User);
        // Save
        if(! $user->save()){
            // Return response for ajax call
            return response()->json([
                'result' => false
            ], 404);
        }

        // Return response for ajax call
        return $user;
    }

	/**
	 * Updates an existing user
	 *
	 * @param  SaveFaq $request
	 * @return JSON Response
	*/	
	public function update(Request $request)
	{
        // For ACL, only allows supplied roles to access this method
        $this->authorizeRoles(['admin']);

        // Validate and populate the request
        $user = $this->validateUser($request, User::find($request->id));
        // Attempt to store model
        $result = $user->save();
        // Verify success on store
        if(! $result){
            // Return response for ajax call
            return response()->json([
                'result' => false
            ], 404);
        }

        // Return response for ajax call
        return $user;
	}

    /**
     * Changes a users password in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JSON response
     */
    public function changePassword(Request $request)
    {
        // For ACL, only allows supplied roles to access this method
        $this->authorizeRoles(['admin']);

        // Validate request
        $this->validate($request, [
            'id' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
        ]);
        // Find the user to change password of in storage
        $user = User::find($request->id);
        // Return failed response if collection empty
        if(! $user){
            // Return response for ajax call
            return response()->json([
                'result' => false
            ], 404);
        }
        // Bcrypt password and add to model
        $user->password = bcrypt($request->password);
        // Attempt to save user
        $result = $user->save();
        // Verify success on store
        if(! $result){
            // Return response for ajax call
            return response()->json([
                'result' => false
            ], 404);
        }

        // Return successful response for ajax call
        return $user;
    }  

	/**
	 * Remove a user
	 *
	 * @param  Integer $id - ID of the user to remove
	 * @return JSON Response
	*/	
  public function remove($id)
  {
    // For ACL, only allows supplied roles to access this method
    $this->authorizeRoles(['admin']); 
       
    // Ensure key is a number
    if(is_numeric($id)){
        // Find user
        $user = User::find($id);

        // Remove user
        if($user->delete()){
            // Return response for ajax call
            return $id;               
        }        
    }
  }

}
