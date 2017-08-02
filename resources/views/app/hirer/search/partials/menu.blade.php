<ul class="profile-steps p-lr-15 no-justify" style="">
    <li>
        <a {!! (isset($editing) && $editing&& (isset($search) && is_numeric($search->id) ) ? 'href="'.route('hirer.search.vacancydetails.edit', $search->id).'"' :'') !!}
                {{ (\Request::route()->getName() == "hirer.search.vacancydetails")||  (\Request::route()->getName() == "hirer.search.vacancydetails.edit") ? 'class=active' : '' }}>Vacancy
            Details</a>
    </li>
    <li>
        <a {!! (isset($editing) && $editing && (isset($search) && is_numeric($search->id) ) ? 'href="'.route('hirer.search.candidatefilters.edit', $search->id).'"' :'') !!}
                {{ (\Request::route()->getName() == "hirer.search.candidatefilters") ||  (\Request::route()->getName() == "hirer.search.candidatefilters.edit") ? 'class=active' : '' }}>Candidate
            Filters</a>
    </li>
    <li>
        <a {!! (isset($search) && is_numeric($search->id) ? 'href="'.route('hirer.search.results', $search->id).'"' :'') !!}
                {{ (\Request::route()->getName() == "hirer.search.results") ? 'class=active' : '' }}>Results</a>
    </li>
</ul>