<span class="fs-16">Profile</span>
<hr class="m-top-10">
<div class="row">
    <div class="col-sm-6">
        <ul class="list-unstyled">
            <li class="m-top-5">
                <span class="text-green fs-12">Has Degree</span><br>
                <strong>@{{ has_degree }}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Has LPC</span><br>
                <strong>@{{ has_lpc }}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Member of Institute of Paralegals</span><br>
                <strong>@{{ member_institute_paralegals }}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Member of CILEx</span><br>
                <strong>@{{ member_of_cilex }}</strong>
            </li>
            <li class="m-top-5">
                <span class="text-green fs-12">Years Experience</span><br>
                <strong>@{{ years_experience }}</strong>
            </li>
        </ul>
    </div>
    <div class="col-sm-6">
        <ul class="list-unstyled">
            <li class="m-top-5">
                <span class="text-green fs-12">Date available</span><br>
                <strong>@{{ available_date }}</strong>
            </li>
            <li class=" m-top-5">
                <span class="text-green fs-12">Skills</span><br>
                <strong>
                    @{{#each training_seats}}
                    @{{#ifGreatThan 2 @index}}
                    @{{this}},
                    @{{else}}
                    @{{break}}
                    <span class="badge badge-black items-modal @{{#ifGreatThan @index 2}}hidden@{{/ifGreatThan}}"
                          data-title="Current Skills"
                          data-template=".items-modal-template"
                          data-items='@{{ toJSON @root 'training_seats' }}'>+@{{ getDifference @index @root 'training_seats'}}</span>
                    @{{/ifGreatThan}}
                    @{{/each}}
                </strong>
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
