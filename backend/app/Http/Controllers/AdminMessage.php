<?php

namespace App\Http\Controllers;
use App\Message;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class AdminMessage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('is_active', '=', 1)->where('role_id', '!=', 1)->orderBy('name', 'ASC')->get();

        return view('admin.message.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if (request()->has('wid')) 
        {
            $user = User::findOrFail($input['wid']);

            $msg = Message::where('user_id', '=', $input['wid'])->orderBy('id', 'DESC')->get();

            echo "<div class='col-md-12'>

                <div class='table-responsive'>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>".$user->name."</td>
                                <td>".$user->mobile_number."</td>
                                <td>".$user->email."</td>
                                <td><a class='btn btn-primary btn-xs' data-toggle='modal' data-target='#myModal'><i class='fa fa-paper-plane fa-fw'></i> Send Message</a></td>
                            <tr>
                        </tbody>
                    </table>
                </div>

            </div>";
            if (count($msg) != 0) 
            {
               echo "<div class='col-md-12'>

                <div class='table-responsive'>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

                        foreach ($msg as $key ) 
                        {
                           echo "<tr>
                                <td>".$key->msg." - <span style='font-size:11px;'>".$key->created_at->diffForHumans()."</span></td>
                                <td>";

                                if ($key->status == 0) 
                                {
                                    echo "<button class='btn btn-danger btn-xs'>Incomplete</button>";
                                }
                                else
                                {
                                    echo "<button class='btn btn-success btn-xs'>Complete</button>";
                                }

                                echo "</td>
                            <tr>";
                        }

                        echo "</tbody>
                    </table>
                </div>

            </div>";
            }
            


            echo '<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message - '.$user->name.'</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="'.route('admin-message.store').'">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" value="'.$user->id.'" name="user_id">
          <textarea class="form-control" rows="3" required="required" name="message" placeholder="Type here"></textarea><br/>
          <center><button class="btn btn-success"><i class="fa fa-paper-plane"></i> Send</button></center>
        </form>
      </div>
    </div>

  </div>
</div>';
        }
        else
        {
            Message::create([

                'user_id' => $input['user_id'],
                'msg' => $input['message']

            ]);

            Session::flash('insert', 'Successfully Sent! ');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
