<table class="table">
    <tr class="cv-row">
        <td colspan="5">
            <div class="p-top-0">
                @include('app.partials.profile-popup')
                <span class="fs-16 m-top-20">Preferences</span>
                <hr class="m-top-10">
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-unstyled">
                            <li>
                                <span class="text-green fs-12">Departments of Interest</span><br>
                                <strong>
                                    @{{#each prefered_departments}}
                                    @{{#ifGreatThan 2 @index}}
                                    @{{this}},
                                    @{{else}}
                                    @{{break}}
                                    <span class="badge badge-black items-modal @{{#ifGreatThan @index 2}}hidden@{{/ifGreatThan}}"
                                          data-title="Departments of Interest"
                                          data-template=".items-modal-template"
                                          data-items='@{{ toJSON @root 'prefered_departments' }}'>+@{{ getDifference @index @root 'prefered_departments'}}</span>
                                    @{{/ifGreatThan}}
                                    @{{/each}}
                                </strong>
                            </li>
                            <li>
                                <span class="text-green fs-12">Locations</span><br>
                                <strong>
                                    @{{#each prefered_locations}}
                                    @{{#ifGreatThan 2 @index}}
                                    @{{this}},
                                    @{{else}}
                                    @{{break}}
                                    <span class="badge badge-black items-modal @{{#ifGreatThan @index 2}}hidden@{{/ifGreatThan}}"
                                          data-title="Locations"
                                          data-template=".items-modal-template"
                                          data-items='@{{ toJSON @root 'prefered_locations' }}'>+@{{ getDifference @index @root 'prefered_locations'}}</span>
                                    @{{/ifGreatThan}}
                                    @{{/each}}
                                </strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-unstyled">
                            <li>
                                <span class="text-green fs-12">Minimum Salary</span><br>
                                <strong>@{{ minimum_salary_text }}</strong>
                            </li>
                            <li>
                                <span class="text-green fs-12">Type of Firm</span><br>
                                <strong>
                                    @{{#each prefered_law_firm_bands}}
                                    @{{#ifGreatThan 2 @index}}
                                    @{{this}},
                                    @{{else}}
                                    @{{break}}
                                    <span class="badge badge-black items-modal @{{#ifGreatThan @index 2}}hidden@{{/ifGreatThan}}"
                                          data-title="Type of Firm"
                                          data-template=".items-modal-template"
                                          data-items='@{{ toJSON @root 'prefered_law_firm_bands' }}'>+@{{ getDifference @index @root 'prefered_law_firm_bands'}}</span>
                                    @{{/ifGreatThan}}
                                    @{{/each}}
                                </strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
