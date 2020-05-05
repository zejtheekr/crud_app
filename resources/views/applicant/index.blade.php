<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Applicant CRUD App</title>

    <!--Bootstrap-->
      <!--CSS-->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!--Javascript-->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <!--End of Bootstrap-->

  </head>
  <body>
    <!-- Header -->
  <style media="screen">
      .container{
        padding:0.5%;
      }
  </style>
  <div class="container">
  <h2 class="alert alert-success">Laravel CRUD Application</h2>
  <div class="row">
    <!-- Add applicant button -->
    <style media="screen">
      .btn{
        margin-bottom: 1%;
      }
    </style>
  <a href="" class="btn btn-info" style="margin-left:87%" id="add_applicant" data-toggle="modal" data-target="#exampleModal">CREATE APPLICATION</a>
  <div class="col-md-12">

  @if($message = Session::get('success'))
  <div class="alert-success">
    <p>{{ $message }}</p>
  </div>
  @endif
  <!--TABLE-->
  <table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th><input type="checkbox" id="select_all" class="selectall"></th>
      <th>#</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Gender</th>
      <th>Position</th>
      <th>Remarks</th>
      <th></th>
    </tr>
    <tbody>
    @foreach($applicants as $key=>$applicant)
      <tr>
        <td><input type="checkbox" id="single_box" name="ids[]" class="selectbox" value="{{ $applicant->id }}"></td>
        <td>{{ ++$key }}</td>
        <td>{{ $applicant->first_name }}</td>
        <td>{{ $applicant->last_name }}</td>
        <td>{{ $applicant->gender }}</td>
        <td>{{ $applicant->position }}</td>
        <td>{{ $applicant->about }}</td>
        <td  width="250">
          <!--READ BUTTON-->
          <button type="button" id="read_button" data-applicant_id="{{ $applicant->id }}"
            data-first_name="{{ $applicant->first_name }}"
            data-last_name="{{ $applicant->last_name }}"
            data-gender="{{ $applicant->gender }}"
            data-position="{{ $applicant->position }}"
            data-about="{{ $applicant->about }}"
            data-toggle="modal" data-target="#exampleModal-read" class="btn btn-primary btn-sm">READ INFORMATION</button>
          <!--END OF READ BUTTON-->
          <!--EDIT BUTTON-->
          <button type="button" id="edit_button" data-applicant_id="{{ $applicant->id }}"
            data-first_name="{{ $applicant->first_name }}"
            data-last_name="{{ $applicant->last_name }}"
            data-gender="{{ $applicant->gender }}"
            data-position="{{ $applicant->position }}"
            data-about="{{ $applicant->about }}"
            data-toggle="modal" data-target="#exampleModal-edit" class="btn btn-secondary btn-sm">UPDATE</button>
          <!--END OF EDIT BUTTON-->
          <button type="button" id="delete_button" data-applicant_id="{{ $applicant->id }}" data-toggle="modal" data-target="#exampleModal-delete" class="btn btn-dark btn-sm">DELETE</button>
        </td>
      </tr>
      @endforeach
      </tbody>
      {{ $applicants->links() }}
  </thead>
  </table>
  <!-- <form method="post">
    @csrf
    @method('DELETE')
    <button type="button" data-applicant_id="{{ $applicant->id }}" data-toggle="modal" data-target="#exampleModal-delete" class="btn btn-dark btn-sm">DELETE SELECTED</button>
  </form> -->
  <script type="text/javascript">
    $('.selectall').click(function(){
      $('.selectbox').prop('checked', $(this).prop('checked'));
    })
    $('.selectbox').change(function(){
      var total = $('.selectbox').length;
      var number = $('.selectbox:checked').length;
      if(total == number){
        $('.selectall').prop('checked', true);
      }
      else{
        $('.selectall').prop('checked', false);
      }
    })
  </script>
  <!--END OF TABLE-->

  <!--ADD NEW APPLICANT MODAL-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-notify modal-right modal-success" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Applicant Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form class="" action="{{ route('applicant.store') }}" method="post">
          @csrf
            <!-- First and Last Name -->
            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">First Name and Last Name</span>
            </div>
            <input type="text" class="form-control" id="f_name" name="first_name" placeholder="Enter First Name" required>
            <input type="text" class="form-control" id="l_name" name="last_name" placeholder="Enter Last Name" required>
            </div>
            <!-- End First and Last Name -->
            <br>
            <!-- Gender -->
            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Gender</span>
            </div>
            </div>
            <div class="form-check" style="margin-left:1%">
              <input class="form-check-input" type="radio" name="gender" id="gender_male" value="M" required>
              <label class="form-check-label" for="gender_male">
                Male
              </label>
            </div>
            <div class="form-check" style="margin-left:1%">
              <input class="form-check-input" type="radio" name="gender" id="gender_female" value="F" required>
              <label class="form-check-label" for="gender_female">
                Female
              </label>
            </div>
            <br>
            <!-- Gender End -->
            <!-- Position -->
            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Position</span>
            </div>
            <br>
            <style media="screen">
              .dropdown{
                color:gray;
              }
            </style>
            <select class="dropdown" id="pos_drop" name="position" placeholder"Select Position" required>
              <option value="">Select Position</option>
              <option id="1" value="Front End Developer">Front End Developer</option>
              <option id="2" value="QA Specialist">QA Specialist</option>
              <option id="3" value="Web Designer">Web Designer</option>
              <option id="4" value="UI/UX Designer">UI/UX Designer</option>
            </select>
            </div>
            <!-- Position End -->
            <br>
            <div class="input-group">
            <div class="input-group-prepend">
            </div>
            <textarea type="text" id="remarks_area" class="form-control" name="about" rows="8" cols="80" placeholder="Applicant Summary" required></textarea>
            </div>
            <br>


          </div>
          <div class="modal-footer">
            <button type="button" id="cancel_submit" class="btn btn-warning" data-dismiss="modal">Close</button>
            <button type="submit" id="submit_applicant" class="btn btn-success">Save Applicant</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!--END OF ADD APPLICANT MODAL-->
    <!--EDIT APPLICANT MODAL-->
      <div class="modal fade left" id="exampleModal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-notify modal-right modal-success" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Applicant Information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="" action="{{ route('applicant.update', 'applicant_id') }}" method="post">
            @csrf
            @method('PUT')
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">First Name and Last Name</span>
              </div>
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
              </div>
              <input type="hidden" id="applicant_id" name="applicant_id">
              <br>
              <!-- Gender -->
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Gender</span>
              </div>
              <style media="screen">
                .dropdown{
                  color:gray;
                }
              </style>
              <select class="dropdown" name="gender" id="gender" placeholder"Select Gender">
                <option value="Not Specified">Select Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
              </select>
              </div>
              <br>
              <!-- Gender End -->
              <!-- Position -->
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Position</span>
              </div>
              <br>
              <style media="screen">
                .dropdown{
                  color:gray;
                }
              </style>
              <select class="dropdown" name="position" id="position" placeholder"Select Position" required>
                <option value="">Select Position</option>
                <option value="Front End Developer">Front End Developer</option>
                <option value="QA Specialist">QA Specialist</option>
                <option value="Web Designer">Web Designer</option>
                <option value="UI/UX Designer">UI/UX Designer</option>
              </select>
              </div>
              <!-- Position End -->
              <br>
              <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <textarea type="text" class="form-control" name="about" id="about" rows="8" cols="80" placeholder="Applicant Summary" required></textarea>
              </div>
              <br>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
              <button type="submit" id="update_applicant" class="btn btn-info">Update Applicant</button>
            </div>
            </form>
          </div>
        </div>
      </div>
        <!--END EDIT APPLICANT MODAL-->
        <!--DELETE APPLICANT MODAL-->
          <div class="modal fade" id="exampleModal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notify modal-right modal-danger" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Applicant</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body modal-danger">
                <form class="" action="{{ route('applicant.destroy', 'applicant_id') }}" method="post">
                @csrf
                @method('DELETE')
                  <input type="hidden" id="applicant_id" name="applicant_id">
                  <p class="text-center" width="50px">Are You Sure You want to Delete This Applicant?</p>

                </div>
                <div class="modal-footer">
                  <button type="button" id="delete_cancel" class="btn btn-warning" data-dismiss="modal">No / Cancel</button>
                  <button type="submit" id="delete_yes" class="btn btn-danger">Yes / Delete Applicant</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!--END OF DELETE APPLICANT MODAL-->
          <!--READ APPLICANT MODAL-->
            <div class="modal fade left" id="exampleModal-read" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-notify modal-right modal-warning" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Applicant Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form class="" action="{{ route('applicant.show', 'applicant_id') }}" method="get">
                  @csrf
                    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">First Name and Last Name</span>
                    </div>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" readonly>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" readonly>
                    </div>
                    <input type="hidden" id="applicant_id" name="applicant_id">
                    <br>
                    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Gender</span>
                    </div>
                    <style media="screen">
                      .dropdown{
                        color:gray;
                      }
                    </style>
                    <select class="dropdown" name="gender" id="gender" placeholder"Select Gender" disabled>
                      <option value="Not Specified"Select Gender</option>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                    </select>
                    </div>
                    <br>
                    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Position</span>
                    </div>
                    <input type="text" class="form-control" name="position" id="position" placeholder="Enter Desired Position" readonly>
                    </div>
                    <br>
                    <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <textarea type="text" class="form-control" name="about" id="about" rows="8" cols="80" placeholder="Applicant Summary" readonly></textarea>
                    </div>
                    <br>


                  </div>
                  <div class="modal-footer">
                    <button type="button" id="close_show" class="btn btn-info" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          <!--END READ APPLICANT MODAL-->

  </div>
  </div>
  </div>
  </body>
  <!-- Footer -->
  <footer class="page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
      <a href="https://instagram.com/_thereelj/" id="IG_link">IG: Jez Yañez</a>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->
  <script>
    $('#exampleModal-edit').on('show.bs.modal', function(event){
      var button = $(event.relatedTarget)
      var first_name = button.data('first_name')
      var last_name = button.data('last_name')
      var gender = button.data('gender')
      var position = button.data('position')
      var about = button.data('about')
      var applicant_id= button.data('applicant_id')

      var modal = $(this)

      modal.find('.modal-title').text('Edit Applicant Information');
      modal.find('.modal-body #first_name').val(first_name);
      modal.find('.modal-body #last_name').val(last_name);
      modal.find('.modal-body #gender').val(gender);
      modal.find('.modal-body #position').val(position);
      modal.find('.modal-body #about').val(about);
      modal.find('.modal-body #applicant_id').val(applicant_id);

    });

    $('#exampleModal-delete').on('show.bs.modal', function(event){
      var button = $(event.relatedTarget)
      var applicant_id= button.data('applicant_id')

      var modal = $(this)

      modal.find('.modal-title').text('Delete Applicant Information');
      modal.find('.modal-body #applicant_id').val(applicant_id);

    });

    $('#exampleModal-read').on('show.bs.modal', function(event){
      var button = $(event.relatedTarget)
      var first_name = button.data('first_name')
      var last_name = button.data('last_name')
      var gender = button.data('gender')
      var position = button.data('position')
      var about = button.data('about')
      var applicant_id= button.data('applicant_id')

      var modal = $(this)

      modal.find('.modal-title').text('View Applicant Information');
      modal.find('.modal-body #first_name').val(first_name);
      modal.find('.modal-body #last_name').val(last_name);
      modal.find('.modal-body #gender').val(gender);
      modal.find('.modal-body #position').val(position);
      modal.find('.modal-body #about').val(about);
      modal.find('.modal-body #applicant_id').val(applicant_id);

    });

  </script>


</html>
