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

        // Create Candidate FAQs page
        factory(Pages::class)->create([
            'title' => 'Candidate FAQs',
            'url' => 'candidate-faqs',
            'entry' => $this->getCandidateFAQsEntry(),
            
        ]);

        // Create Hirer FAQs page
        factory(Pages::class)->create([
            'title' => 'Employers',
            'url' => 'hirer-faqs',
            'entry' => $this->getHirerFAQsEntry(),
            
        ]);
    }

    public function getCandidateFAQsEntry()
    {
        return '
            
            <h3 class="question-title">
                Q: What is ' . config('brand.identity.fullname') . '?
            </h3>

            <p>
                ' . config('brand.identity.fullname') . ' is a matching platform designed primarily for Paralegal and Legal Support staff.
            </p>

            <p>
                Candidates set their preferences and are instantly matched to searches saved by companies.
            </p>

            <p>
                Following a new Employer search, anonymised candidate profiles are presented depending on your job preferences. You can select companies you do not want to be matched with and your profile will be hidden from your current employer.
            </p>

            <h3 class="question-title">
                Q: How does it work?
            </h3>

            <ol>
                <li>You create a profile which usually takes around 5 minutes.</li>
                <li>We will send you a confirmation email and you will be asked to check your profile through one more time.</li>
                <li>If you are happy with your preferences you can go live. Employers with saved searches will be notified if you are a matching candidate.</li>
                <li>When employers conduct a new search, your anonymised profile will be presented. Only if they meet your requirements.</li>
                <li>Employers can request your CV, you will know the company, salary information, location and any extra information they wish to present.</li>
                <li>You will be able to accept or decline this request directly from the email or from your dashboard when logged in. One of our team will also be in touch shortly after a CV request has been made.</li>
                <li>Following an accepted CV request, our team will be on hand to arrange interviews and throughout the hiring process.</li>
            </ol>

            <p>
                ' . config('brand.identity.fullname') . ' is currently designed for Paralegal and Legal Support staff with any level of experience. We are also an international platform, you will be able to select international locations you would be willing to work.
            </p>

            <p>
                We will also feature some jobs on our blogs/jobs page so keep an eye on this.
            </p>

            <h3 class="question-title">
                How much does it cost?
            </h3>

            <p>
                ' . config('brand.identity.fullname') . ' is <strong>completely free for candidates</strong> to use.
            </p>

            <h3 class="question-title">
                How long does it take to register?
            </h3>

            <p>
                Registration will take around 5 to 10 minutes.
            </p>

            <p>
                Your profile is saved, and you can pick up where you left off at any time.
            </p>

            <p>
                You can edit your preferences at anytime by logging in and clicking on the profile and preferences menu.
            </p>

            <h3 class="question-title">
                What do I need to complete my Profile?
            </h3>

            <p>
                You will need an up to date CV (Resume) in either word (.doc or .docx) or PDF file format.
            </p>

            <h3 class="question-title">
                Will my CV ever be published online?
            </h3>

            <p>
                Your CV will <strong>never</strong> be published online.
            </p>

            <p>
                <strong>We only release your CV following your express consent to employers who match your role requirements.</strong>
            </p>

            <h3 class="question-title">
                Who can see my anonymous Profile?
            </h3>

            <p>
                Only companies and law firms who match your work preferences and profile will be able to see your anonymous profile in search results.
            </p>

            <h3 class="question-title">
                Can my current company see my anonymous Profile?
            </h3>

            <p>
                Your current company will <strong>never</strong> see your profile.
            </p>

            <p>
                During registration, if your company is not listed please select ‘Not Listed’ and send us the company name,
                with their corporate email domain (for example ' . config('brand.email.domain') . '). We will add the company to our database and ensure
                your profile has been amended so you are not found by your employer if they choose to use ' . config('brand.identity.fullname') . '.
            </p>

            <h3 class="question-title">
                How should I set my preferences?        
            </h3>

            <p>
                We recommend you set your preferences to reflect a role you would like to accept.
            </p>

            <p>
                We would like to provide a good service to both employers and candidates therefore having an accurate profile will assist us to provide a great service!
            </p>

            <p>
                Please try and be accurate with your education, preferences, language skills and location requirements.
            </p>

            <h3 class="question-title">
                Can I change my Profile and Preferences?
            </h3>

            <p>
                Yes, simply login and click on the &lsquo;My Profile & Preferences&rsquo; option. You can change your preferences and experience or upload a CV from here.
            </p>

            <p>
                Please ensure this is an accurate reflection of your experience, we will be checking this to make sure it is a great experience for employers using ' . config('brand.identity.fullname') . '.
            </p>

            <h3 class="question-title">
                How will I know when an employer is interested?
            </h3>

            <p>
                Employers can send CV requests if they match your vacancy requirements and you match their candidate criteria.
            </p>

            <p>
                You will receive an email with some key details (salary, location, company name), where you can either accept or decline the employer&rsquo;s CV request.
            </p>

            <h3 class="question-title">
                What happens once my CV has been sent to an employer?
            </h3>

            <p>
                When you accept a CV request a ' . config('brand.identity.fullname') . ' staff member will contact the employer within 48 hours to gather feedback.
            </p>

            <p>
                If successful we will arrange interviews and are on hand throughout the hiring process.
            </p>

            <h3 class="question-title">
                Can I track the progress of my applications?
            </h3>

            <p>
                Once you have created your Profile you will have access to your login area and dashboard. You can see CV requests that are outstanding and can track the progress of your applications through here.
                The Dashboard area will also allow you to review and edit your Profile and Preferences.
            </p>            
        ';    
    }
    
    public function getHirerFAQsEntry()
    {
        return '
            
            <h3 class="question-title">
                Q: What is ' . config('brand.identity.fullname') . '?
            </h3>

            <p>
                ' . config('brand.identity.fullname') . ' is an efficient matching platform with a database of pre-vetted paralegal and legal support candidates who match your vacancy and candidate requirements.
            </p>

            <p>
                You can conduct a search and within seconds will be presented with suitable anonymised candidate profiles. You can also save searches to get notified when matching candidates register with ' . config('brand.identity.fullname') . '.
            </p>

            <p>
                Multiple CVs (Resume&rsquo;s) can be requested, with candidates being informed immediately following your CV request.
            </p>

            <p>
                Candidates will have the option to Accept or Decline your CV request immediately following your request.
            </p>
    
            <p>
                Our consultants will be on hand to speak to candidates and arrange interviews. We will also be on hand to assist throughout the hiring process.
            </p>            

            <h3 class="question-title">
                Q: How does it work?
            </h3>

            <p>
                Simply register using your corporate email address (it takes a couple of minutes).
            </p>

            <p>
                Begin searching for Paralegal and Legal Support candidates immediately.
            </p>

            <p>
                You are only matched to candidates who are interested in working for your company and match your vacancy criteria.
            </p>

            <p>
                Request CVs and begin receiving candidate replies within 24 hours.
            </p>

            <p>
                A ' . config('brand.identity.fullname') . ' consultant will be on hand to assist with interviews, meetings and in general throughout the hiring process.
            </p>

            <p>
                Save your search and receive notifications when suitable candidates register. It is our aim to take the hassle out of recruitment with a target to place candidates within a week of a match being made.
            </p>

            <h3 class="question-title">
                How long will it take to register and begin searching?
            </h3>

            <p>
                It will take a few minutes to register and begin searching.
            </p>

            <p>
                Drop us a call or an email and we will be happy to set your account up.
            </p>

            <h3 class="question-title">
                How much does it cost?
            </h3>

            <p>
                Searching for candidates is completely free.
            </p>

            <p>
                We charge a flat &pound;995+VAT fee on a successful candidate placement.
            </p>

            <h3 class="question-title">
                Do you offer a refund if the hire does not work out?
            </h3>

            <p>
                We offer a candidate guarantee for permanent staff for 30 days following a successful placement. If a permanent staff member does not stay within 30 days following a successful placement,
                we will provide a refund or carry on assisting you until your vacancy has been filled.
            </p>

            <h3 class="question-title> 
                When should we use ' . config('brand.identity.fullname') . '
            </h3>
            
            <p>
                Whenever there is a requirement or will be a requirement for Paralegal and Legal Support staff.
            </p>

            <h3 class="question-title">
                Can we have multiple users?
            </h3>

            <p>
                You can have multiple users registered to use ' . config('brand.identity.fullname') . '.
            </p>

            <p>
                For example, HR staff, specific teams or the department head can all register (with their email address), conduct and save a search with unique results being presented in their respective dashboards.
            </p>

            <h3 class="question-title">
                Will we be able to view CVs on the site?
            </h3>

            <p>
                You will not be able to view CVs as the candidate has to accept your CV request.
            </p>

            <p>
                We will however contact candidates shortly after your request to ensure a smooth and efficient hiring process.
            </p>

            <h3 class="question-title">
                Will we be matched with Candidates who are currently working for our business?
            </h3>

            <p>
                Candidate profiles will not match with their current employer.
            </p>

            <h3 class="question-title">
                What should we do if we do not get any results when conducting a search?
            </h3>

            <p>
                You can broaden your search criteria or save your search.
            </p>

            <p>
                Saved searches will send you an email notifying you when a suitable candidate registers with ' . config('brand.identity.fullname') . '.
            </p>

            <h3 class="question-title">
                What happens when we request a CV?
            </h3>

            <p>
                When a CV is requested the candidate will receive an email with your vacancy details. They can accept or decline your request from this email.
            </p>

            <p>
                A consultant will also be in touch with the candidate shortly after you send a CV request.
            </p>

            <p>
                If the candidate accepts your CV request you will be able to download it from your dashboard. We will also be in touch for feedback and the candidates CV.
            </p>

            <p>
                If the candidate is of interest, we will assist you to arrange interviews and will act as the recruitment agent.
            </p>

            <p>
                We will be on hand throughout the hiring process until the candidate has been successfully placed.
            </p>

            <h3 class="question-title">
                Can we track the progress of applications via the site?
            </h3>

            <p>
                You can login at and will have access to the candidates you are currently engaging with. We will regularly update the candidate’s status in your dashboard.
            </p>

            <p>
                A ' . config('brand.identity.fullname') . ' consultant will also be on hand to assist you throughout.
            </p>

        ';    
    }
    
}
