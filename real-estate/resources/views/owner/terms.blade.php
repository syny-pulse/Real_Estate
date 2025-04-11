@extends('layouts.app')
@section('content')

<!-- Terms and Conditions Container -->
<div class="max-w-5xl mx-auto px-4 py-12 md:py-16">
    <div class="bg-white rounded-lg shadow-md p-6 md:p-10">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Terms and Conditions</h1>
            <p class="text-gray-600">Last Updated: April 11, 2025</p>
        </div>

        <!-- Introduction -->
        <div class="mb-8">
            <p class="text-gray-700 mb-4">
                Welcome to Property Finder. Please read these Terms and Conditions carefully before using our website or services. By accessing or using Property Finder, you agree to be bound by these Terms and Conditions.
            </p>
            <p class="text-gray-700">
                If you disagree with any part of these terms, you may not access our website or use our services.
            </p>
        </div>

        <!-- Definitions -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Definitions</h2>
            <ul class="list-disc pl-6 mb-4 text-gray-700 space-y-2">
                <li><span class="font-medium">"Service"</span> refers to the Property Finder website and all related services.</li>
                <li><span class="font-medium">"User,"</span> "You," and "Your" refers to individuals accessing or using our Service.</li>
                <li><span class="font-medium">"Property Owner"</span> refers to users who list properties on our Service.</li>
                <li><span class="font-medium">"Property Seeker"</span> refers to users who search for and inquire about properties.</li>
                <li><span class="font-medium">"Content"</span> refers to text, images, videos, audio, graphics, and other material that may be viewed on our Service.</li>
                <li><span class="font-medium">"Property Finder,"</span> "We," "Us," and "Our" refers to the operators of this Service.</li>
            </ul>
        </div>

        <!-- Account Registration -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Account Registration</h2>
            <p class="text-gray-700 mb-4">
                To use certain features of our Service, you may be required to register for an account. You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate, current, and complete.
            </p>
            <p class="text-gray-700 mb-4">
                You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password. You agree not to disclose your password to any third party.
            </p>
            <p class="text-gray-700">
                We reserve the right to terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including, without limitation, if you breach these Terms and Conditions.
            </p>
        </div>

        <!-- Property Listings -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Property Listings</h2>
            <h3 class="text-xl font-medium text-gray-800 mb-3">For Property Owners</h3>
            <p class="text-gray-700 mb-4">
                As a Property Owner, you agree to:
            </p>
            <ul class="list-disc pl-6 mb-4 text-gray-700 space-y-2">
                <li>Provide accurate and up-to-date information about your property.</li>
                <li>Upload only authentic images and videos of your property.</li>
                <li>Respond promptly to inquiries from Property Seekers.</li>
                <li>Update the availability status of your property when it is no longer available.</li>
                <li>Comply with all applicable laws and regulations related to property rental or sale.</li>
            </ul>
            
            <h3 class="text-xl font-medium text-gray-800 mb-3">For Property Seekers</h3>
            <p class="text-gray-700 mb-4">
                As a Property Seeker, you agree to:
            </p>
            <ul class="list-disc pl-6 mb-4 text-gray-700 space-y-2">
                <li>Provide accurate personal information when making inquiries.</li>
                <li>Use the contact information provided only for the purpose of property inquiries.</li>
                <li>Respect the privacy and property of Property Owners during property viewings.</li>
                <li>Not engage in spamming or harassment of Property Owners.</li>
            </ul>
        </div>

        <!-- User Content -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">User Content</h2>
            <p class="text-gray-700 mb-4">
                Our Service allows you to post, link, store, share, and otherwise make available certain information, text, graphics, videos, or other material. By providing User Content, you grant us a non-exclusive, worldwide, royalty-free, sublicensable, and transferable license to use, reproduce, modify, adapt, publish, translate, and distribute your User Content in connection with our Service.
            </p>
            <p class="text-gray-700 mb-4">
                You are solely responsible for your User Content and the consequences of posting or publishing it. We do not endorse any User Content or any opinion, recommendation, or advice expressed therein, and we expressly disclaim any liability in connection with User Content.
            </p>
            <p class="text-gray-700">
                We reserve the right to remove any User Content from our Service at our discretion, without prior notice, for any reason whatsoever, including, but not limited to, if your User Content violates these Terms and Conditions.
            </p>
        </div>

        <!-- Prohibited Activities -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Prohibited Activities</h2>
            <p class="text-gray-700 mb-4">
                You agree not to use our Service:
            </p>
            <ul class="list-disc pl-6 mb-4 text-gray-700 space-y-2">
                <li>In any way that violates any applicable national or international law or regulation.</li>
                <li>To transmit, or procure the sending of, any advertising or promotional material, including any "junk mail," "chain letter," "spam," or any other similar solicitation.</li>
                <li>To impersonate or attempt to impersonate Property Finder, a Property Finder employee, another user, or any other person or entity.</li>
                <li>To engage in any other conduct that restricts or inhibits anyone's use or enjoyment of the Service, or which may harm Property Finder or users of the Service.</li>
                <li>To introduce any viruses, Trojan horses, worms, logic bombs, or other material which is malicious or technologically harmful.</li>
                <li>To attempt to gain unauthorized access to, interfere with, damage, or disrupt any parts of the Service, the server on which the Service is stored, or any server, computer, or database connected to the Service.</li>
            </ul>
        </div>

        <!-- Intellectual Property -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Intellectual Property</h2>
            <p class="text-gray-700 mb-4">
                The Service and its original content (excluding User Content), features, and functionality are and will remain the exclusive property of Property Finder and its licensors. The Service is protected by copyright, trademark, and other laws of both the United States and foreign countries.
            </p>
            <p class="text-gray-700">
                Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of Property Finder.
            </p>
        </div>

        <!-- Limitation of Liability -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Limitation of Liability</h2>
            <p class="text-gray-700 mb-4">
                In no event shall Property Finder, its directors, employees, partners, agents, suppliers, or affiliates be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from:
            </p>
            <ul class="list-disc pl-6 mb-4 text-gray-700 space-y-2">
                <li>Your access to or use of or inability to access or use the Service.</li>
                <li>Any conduct or content of any third party on the Service.</li>
                <li>Any content obtained from the Service.</li>
                <li>Unauthorized access, use, or alteration of your transmissions or content.</li>
            </ul>
            <p class="text-gray-700">
                Property Finder does not verify the accuracy of listings or user information, and we make no guarantees about the quality, safety, or legality of the properties listed or the truth or accuracy of user content.
            </p>
        </div>

        <!-- Disclaimer -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Disclaimer</h2>
            <p class="text-gray-700 mb-4">
                Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non-infringement, or course of performance.
            </p>
            <p class="text-gray-700">
                Property Finder does not warrant that the Service will function uninterrupted, secure, or available at any particular time or location, or that any errors or defects will be corrected.
            </p>
        </div>

        <!-- Indemnification -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Indemnification</h2>
            <p class="text-gray-700">
                You agree to defend, indemnify, and hold harmless Property Finder and its licensee and licensors, and their employees, contractors, agents, officers, and directors, from and against any and all claims, damages, obligations, losses, liabilities, costs or debt, and expenses (including but not limited to attorney's fees), resulting from or arising out of your use and access of the Service, or your violation of these Terms and Conditions.
            </p>
        </div>

        <!-- Governing Law -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Governing Law</h2>
            <p class="text-gray-700">
                These Terms and Conditions shall be governed and construed in accordance with the laws of Uganda, without regard to its conflict of law provisions. Our failure to enforce any right or provision of these Terms and Conditions will not be considered a waiver of those rights. If any provision of these Terms and Conditions is held to be invalid or unenforceable by a court, the remaining provisions of these Terms and Conditions will remain in effect.
            </p>
        </div>

        <!-- Changes to Terms -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Changes to Terms</h2>
            <p class="text-gray-700 mb-4">
                We reserve the right, at our sole discretion, to modify or replace these Terms and Conditions at any time. If a revision is material, we will try to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.
            </p>
            <p class="text-gray-700">
                By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.
            </p>
        </div>

        <!-- Dispute Resolution -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dispute Resolution</h2>
            <p class="text-gray-700">
                Any disputes arising out of or relating to these Terms and Conditions, including the breach, termination, enforcement, interpretation, or validity thereof, shall first be attempted to be resolved through good-faith negotiations. If such dispute cannot be resolved through negotiation, it shall be submitted to mediation in accordance with the rules of [Mediation Service/Authority] before resorting to arbitration or litigation.
            </p>
        </div>

        <!-- Contact Information -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Contact Us</h2>
            <p class="text-gray-700 mb-4">
                If you have any questions about these Terms and Conditions, please contact us at:
            </p>
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <p class="font-medium text-gray-800 mb-1">Property Finder</p>
                <p class="text-gray-700 mb-1">Kampala, Buganda Road</p>
                <p class="text-gray-700 mb-1">Kampala, Uganda</p>
                <p class="text-gray-700 mb-1">Email: legal@propertyfinder.com</p>
                <p class="text-gray-700">Phone: +256761484052</p>
            </div>
        </div>

        <!-- Acceptance -->
        <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
            <p class="text-blue-800 font-medium">
                By using our Service, you acknowledge that you have read and understood these Terms and Conditions and agree to be bound by them.
            </p>
        </div>
    </div>
</div>

@endsection