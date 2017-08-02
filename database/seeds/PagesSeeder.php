<?php

use Illuminate\Database\Seeder;

use Yab\Quarx\Models\Pages;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pages::truncate();

        //Create About Us page
        factory(Pages::class)->create([
            'title' => 'About us',
            'url' => 'about-us',
            'entry' => $this->getAboutUsEntry(),
            
        ]);
    }

    public function getAboutUsEntry() {
        return "
            <p>
                    NQSolicitors.com is a discrete online matching platform that allows Trainee Solicitors 
                    and Newly Qualified Solicitors to create an anonymous Candidate Profile which can be 
                    matched with private practice law firms who are looking to hire for specific vacancies 
                    at NQ - 2 PQE.
            </p>
            <p>
                    Candidates can register with the site and create a Profile <strong>free of charge
                    </strong>.
            </p>
            <p>
                    Hirers can also register with the site and run a search for free of charge, and will 
                    only be charged a fee of <strong>12.5%</strong> of the Candidate’s first year salary 
                    should they hire a Candidate through NQSolicitors.com.
            </p>
            <p>
                    Hirers will not be able to advertise NQ vacancies on the site and, importantly, 
                    Candidate CVs will NOT be available to view online.
            </p>
            <p>
                    Candidate Profiles will include:
            </p>
            <ul>
                    <li>details of the Candidate’s academic record and experience as a Trainee; and</li>
                    <li>the Candidate’s specific work preferences in relation to location, salary, 
                    preferred department and the type of law firm that they would like to join.</li>
            </ul>   
            <p>
                    Once a Candidate’s anonymous Profile has been uploaded onto the site it can only be 
                    matched with Hirers if:
            </p>
            <ul>
                    <li>the vacancy for which the Hirer is recruiting matches the Candidate’s work 
                    Preferences; and</li>
                    <li>the Candidate’s academic record and training experience meets the Hirer’s minimum 
                    criteria.</li>
            </ul>
            <p>
                    When a Candidate is matched with a Hirer’s specific vacancy, the Hirer will be able to 
                    review the Candidate’s anonymous Profile and request the release of the Candidate’s CV.
            </p>
            <p>
                    The Candidate will then receive a CV Request by e-mail, which will include full details 
                    of the Hirer and the vacancy, and will be invited to either accept or to decline the 
                    request for their CV.
            </p>
            <p>
                    Once a Candidate’s CV has been released to a Hirer for a specific vacancy, 
                    NQSolicitors.com will act as a recruitment consultant in the traditional manner. We 
                    will contact the Hirer within 72 hours of the release of the Candidate’s CV to chase 
                    feedback, and will continue to work with both parties throughout the hiring 
                    process.             
            </p>
            <hr>
            <h2>Message from Ian Roberts (Founder & Managing Director)</h2>
            <p>
                    Thank you for visiting NQSolicitors.com and for taking the time to read a little more 
                    About the Service.
            </p>
            <p>
                    As the platform is new and a challenge to the traditional recruitment model, I thought 
                    it would be a good idea to let you know why we have launched NQSolicitors.com and the 
                    rationale behind our thinking.
            </p>
            <p>
                    Having run Central Legal Personnel, a full-service legal recruitment consultancy, for 
                    the last 13 years, I have worked on an extremely broad range of legal vacancies, from 
                    lateral Partner hires, to junior support staff positions. Throughout this time, I have 
                    thought that junior Solicitor vacancies at NQ - 2 PQE are a special case.
            </p>
            <p>
                    While we are encouraged to believe that recruitment at all levels will, at some time in 
                    the future, be conducted online, the reality is that hiring online can be a thankless 
                    task.
            </p>
            <p>
                    As a legal recruiter, I have been a frequent user of legal jobs boards, but have often 
                    been left frustrated by the inaccuracy of the process and the sheer volume of data that 
                    has to be sifted through to find the odd gem. In addition, it’s clear that high quality 
                    legal professionals do not have the time or inclination to engage with legal jobs 
                    boards.
            </p>
            <p>
                    When hiring mid-level Solicitors at 2+ PQE, the most important part of a Candidate’s CV 
                    is the experience they have gained since qualification. Legal recruiters, (if doing 
                    their job properly), add value by digging deeper than the text on a CV and take time to 
                    understand the precise nature of a Candidate’s PQE.
            </p>
            <p>
                    In my experience, when law firms hire Newly Qualified and Junior Solicitors with less
                    than 2 PQE, a Candidate’s academic record and training are almost always the two most 
                    important factors considered when short-listing Candidates. It is easy, therefore, for 
                    legal recruitment consultants to identify final seat Trainees and NQ Solicitors who are 
                    likely to be invited to attend an interview.
            </p>
            <p>
                    Indeed, on several occasions in the past, when we have presented junior Solicitor CVs 
                    to a client while explaining that we are yet to meet the Candidate, we have been asked 
                    to organise an interview purely on the strength of the Candidate’s academic record and 
                    experience as a Trainee Solicitor / NQ.
            </p>
            <p>
                    In light of this, I began to think that there must be a more efficient way of 
                    recruiting NQ Solicitors. Excuse the analogy, but if online dating (which matches one 
                    party’s profile and preferences to another party’s profile and preferences), has become 
                    such a phenomenon, why can’t we build a platform that matches NQs and Junior Solicitors 
                    with private practice law firms, while protecting the Candidate’s anonymity at all 
                    times?
            </p>
            <p>
                    This is the rationale behind NQSolicitors.com.
            </p>
            <p>
                    Having recently been launched, the site currently caters for NQs and Junior Solicitors 
                    who are seeking NQ vacancies within London-based private practice law firms. However, 
                    once we have gained traction and proved the concept, we will be looking to roll the 
                    service out, nationwide.
            </p>
            <p>
                    We also plan to introduce more variables within the matching algorithm, in order to 
                    open up the service to in-house legal departments and to allow Candidates who were 
                    educated abroad to build a Candidate Profile.
            </p>
            <p>
                    While we are obviously keen for Trainee Solicitors and NQ Solicitors to register with 
                    the site and build an anonymous Candidate Profile, we hope that the site will become a 
                    central forum for Trainees and junior Lawyers, where they will share their experiences 
                    and opinions about a broad range of topics which affect their working lives.
            </p>
            <p>
                    To this end, the site’s blog section will feature regular updates on the NQ recruitment 
                    market, offer an insight into life as an NQ Solicitor, share best practice in relation 
                    to CV writing and interview techniques, and in time, we aim to publish NQ salary 
                    surveys.
            </p>
            <p>
                    So, if you’re a Trainee Solicitor or an NQ Solicitor, but you’re not quite ready to 
                    build a Candidate Profile, engaging with the site will still be of benefit.
            </p>
        ";
    }
}
