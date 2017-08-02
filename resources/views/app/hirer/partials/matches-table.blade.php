<div class="well-20">
    <div class="row">
        <div class="col-sm-12">
            <h4 id="search-name">
                @if ($search->name)
                    Saved Search: {{ $search->name }}
                @endif
            </h4>
        </div>
        <div class="col-sm-12">
            <a id="request-many-cvs-button" class="btn btn-primary fs-12">Request CV</a>
            <span style="display:none" class="loading"></span>
        </div>
    </div>
    <div class="row m-top-20">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table id="matches-table" class="table table-striped m-top-20 b-top">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Candidate Ref</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script id="profile-template" type="text/x-handlebars-template">
    @include('app.hirer.partials.profile-popup')

    @{{#unless match_status_num}}
        <table class="table">
            <tr> 
                <td class="td-btn" >
                    <a data-id="@{{ id }}" class="request-single-cv-button btn btn-primary fs-12 btn-full-width">
                        Request CV
                    </a>
                    <span style="display:none" class="loading"></span>
                </td>
            </tr>
        </table>
    @{{/unless}}
</script>
@include('app.candidate.partials.items-popup-modal')
