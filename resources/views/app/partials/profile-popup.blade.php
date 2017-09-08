<span class="fs-16">Profile</span>
<hr class="m-top-10">
<div class="row">
    <div class="col-sm-6">
        <ul class="list-unstyled">
            <li>
                <span class="text-green fs-12">UCAS Points</span><br>
                <strong>@{{ ucas_points }}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">University Attended</span><br>
                <strong>@{{university_band}}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Degree Class</span><br>
                <strong>@{{ degree_class }}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Training Firm</span><br>
                <strong>
                    @{{training_law_firm_band}}
                </strong>
            </li>
            <li class=" m-top-5">
                <span class="text-green fs-12">Training Seats</span><br>
                <strong>
                    @{{#each training_seats}}
                    @{{#ifGreatThan 2 @index}}
                    @{{this}},
                    @{{else}}
                    @{{break}}
                    <span class="badge badge-black items-modal @{{#ifGreatThan @index 2}}hidden@{{/ifGreatThan}}"
                          data-title="Training Seats"
                          data-template=".items-modal-template"
                          data-items='@{{ toJSON @root 'training_seats' }}'>+@{{ getDifference @index @root 'training_seats'}}</span>
                    @{{/ifGreatThan}}
                    @{{/each}}
                </strong>
            </li>
        </ul>
    </div>
    <div class="col-sm-6">
        <ul class="list-unstyled">
            <li>
                <span class="text-green fs-12">Candidate Undertook Client Secondment</span><br>
                <strong>@{{ taken_client_secondment }}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Date of Qualification</span><br>
                <strong>@{{ date_qualified }}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Candidate Offered {{ config('brand.identity.initials')  }} position</span><br>
                <strong>@{{ did_training_firm_offer_position }}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Current Firm</span><br>
                <strong>@{{current_law_firm_band}}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Additional Languages</span><br>
                <strong>
                    @{{#each languages}}
                    @{{#ifGreatThan 2 @index}}
                    @{{this}},
                    @{{else}}
                    @{{break}}
                    <span class="badge badge-black items-modal @{{#ifGreatThan @index 2}}hidden@{{/ifGreatThan}}"
                          data-title="Languages"
                          data-template=".items-modal-template"
                          data-items='@{{ toJSON @root 'languages' }}'>+@{{ getDifference @index @root 'languages'}}</span>
                    @{{/ifGreatThan}}
                    @{{/each}}
                </strong>
            </li>
        </ul>
    </div>
</div>
