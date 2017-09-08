<div class="row-fluid m-top-100">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-sm-12">
                <h4><i class="brand-sprite brand-static brand-user-blue"></i> {{ $tableTitle }}</h4>
                <div class="well-20 m-top-30">
                    <div class="table-responsive ">
                        <table id="candidates-table" class="table table-striped m-top-20 b-top">
                            <thead>
                                <tr>
                                    <th>Candidate Ref</th>
                                    <th>Search Name</th>
                                    <th>User</th>
                                    <th>Location</th>
                                    <th>Salary</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('app.candidate.partials.items-popup-modal')
<script id="profile-template" type="text/x-handlebars-template">
    @include('app.hirer.partials.profile-popup')
</script>