<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Laravel CRUD Application</title>

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
  <a href="" class="btn btn-info" style="margin-left:87.5%" data-toggle="modal" data-target="#exampleModal">ADD AN APPLICANT</a>
  <div class="col-md-12">

  @if($message = Session::get('success'))
  <div class="alert-success">
    <p>{{ $message }}</p>
  </div>
  @endif
  <main style="margin: 0 auto; min-height: calc(110vh - 250px - -19px);">
  <!--TABLE-->
  <table class="table table-striped">
  <thead class="thead-dark">
    <tr>
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
        <td>{{ ++$key }}</td>
        <td>{{ $applicant->first_name }}</td>
        <td>{{ $applicant->last_name }}</td>
        <td>{{ $applicant->gender }}</td>
        <td>{{ $applicant->position }}</td>
        <td>{{ $applicant->about }}</td>
        <td>
          <!--READ BUTTON-->
          <button type="button" data-applicant_id="{{ $applicant->id }}"
            data-first_name="{{ $applicant->first_name }}"
            data-last_name="{{ $applicant->last_name }}"
            data-gender="{{ $applicant->gender }}"
            data-position="{{ $applicant->position }}"
            data-about="{{ $applicant->about }}"
            data-toggle="modal" data-target="#exampleModal-read" class="btn btn-primary btn-sm">READ INFORMATION</button>
          <!--END OF READ BUTTON-->
          <!--EDIT BUTTON-->
          <button type="button" data-applicant_id="{{ $applicant->id }}"
            data-first_name="{{ $applicant->first_name }}"
            data-last_name="{{ $applicant->last_name }}"
            data-gender="{{ $applicant->gender }}"
            data-position="{{ $applicant->position }}"
            data-about="{{ $applicant->about }}"
            data-toggle="modal" data-target="#exampleModal-edit" class="btn btn-secondary btn-sm">UPDATE</button>
          <!--END OF EDIT BUTTON-->
          <button type="button" data-applicant_id="{{ $applicant->id }}" data-toggle="modal" data-target="#exampleModal-delete" class="btn btn-dark btn-sm">DELETE</button>
        </td>
      </tr>
      @endforeach
      </tbody>
      {{ $applicants->links() }}
  </thead>
  </table>

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
            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">First Name and Last Name</span>
            </div>
            <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
            <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name">
            </div>
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
            <select class="dropdown" name="gender" placeholder"Select Gender">
              <option value="Not Specified">Select Gender</option>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
            </div>
            <br>
            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Position</span>
            </div>
            <input type="text" class="form-control" name="position" placeholder="Enter Desired Position">
            </div>
            <br>
            <div class="input-group">
            <div class="input-group-prepend">
            </div>
            <textarea type="text" class="form-control" name="about" rows="8" cols="80" placeholder="Applicant Summary"></textarea>
            </div>
            <br>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save Applicant</button>
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
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
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
              <select class="dropdown" name="gender" id="gender" placeholder"Select Gender">
                <option value="Not Specified">Select Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
              </select>
              </div>
              <br>
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Position</span>
              </div>
              <input type="text" class="form-control" name="position" id="position" placeholder="Enter Desired Position">
              </div>
              <br>
              <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <textarea type="text" class="form-control" name="about" id="about" rows="8" cols="80" placeholder="Applicant Summary"></textarea>
              </div>
              <br>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Update Applicant</button>
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
                  <button type="button" class="btn btn-warning" data-dismiss="modal">No / Cancel</button>
                  <button type="submit" class="btn btn-danger">Yes / Delete Applicant</button>
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
                    <input type="hidden" id="applicant_id" name="applicant_id" readonly>
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
                    <!-- <select class="dropdown" name="gender" id="gender" placeholder"Select Gender" readonly>
                      <option value="Not Specified">Select Gender</option>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                    </select> -->
                    <input type="text" class="form-control" name="position" id="gender" placeholder="Enter Desired Position" readonly>
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
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          <!--END READ APPLICANT MODAL-->

  </div>
  </div>
  </div>
</main>
  <!-- Footer -->
  <footer class="page-footer font-small blue" style="background:#212529;">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3" style="color:white;">© <script type="text/javascript">document.write(new Date().getFullYear())</script> Copyright:
      <a href="https://www.instagram.com/_thereelj/"> Jezreel Jann V. Yañez</a>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->
  <script>
  </body>
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
