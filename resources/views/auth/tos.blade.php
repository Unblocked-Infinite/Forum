<x-guest-layout>
    <div class="max-w-4xl mx-auto">
        <x-block :title="__('Terms of Service')" :description="__('Please read and accept our Terms of Service to continue.')">

            <div class="">
                <textarea
                    class="prose-invert bg-zinc-800/40 focus:outline-none focus:ring-[#353535] focus:border-[#353535] text-neutral-400 border border-[#303030] w-full"
                    name="" id="" rows="20">
Terms of Service

Last updated: [Date]

Please read these Terms of Service ("Terms") carefully before using the [Your Website Name] website (the "Service") operated by [Your Company Name] ("us", "we", or "our").

Your access to and use of the Service is conditioned upon your acceptance of and compliance with these Terms. These Terms apply to all visitors, users, and others who wish to access or use the Service.

By accessing or using the Service, you agree to be bound by these Terms. If you disagree with any part of the Terms, then you do not have permission to access the Service.

Prohibited Activities

You agree not to use the Service for any of the following activities:

1. Posting, sharing, or distributing any pornographic content or material that is sexually explicit, obscene, or offensive.
2. Engaging in, promoting, or sharing information related to black hat hacking, unauthorized access to computer systems or networks, or any other illegal or unethical hacking activities.
3. Posting, sharing, or distributing any confidential, proprietary, or personal information belonging to others without their consent, including but not limited to leaks, personal data, or trade secrets.
4. Engaging in any activity that violates applicable laws, regulations, or the rights of others, including but not limited to copyright infringement, defamation, harassment, or invasion of privacy.

We reserve the right to terminate or suspend your access to the Service immediately, without prior notice or liability, if you breach these Terms or engage in any prohibited activity.

Changes to Terms

We reserve the right, at our sole discretion, to modify or replace these Terms at any time. By continuing to access or use our Service after any revisions become effective, you agree to be bound by the revised Terms. If you do not agree to the new Terms, you are no longer authorized to use the Service.

Contact Us

If you have any questions about these Terms, please contact us at [Your Contact Email Address].
                </textarea>
            </div>

            <form method="POST" action="{{ route('accept-tos') }}">
                @csrf
                <div class="pt-4">
                    <input type="checkbox" name="accept_tos" id="accept_tos" value="1" required />
                    <label class="text-neutral-400" for="accept_tos">{{ __('I accept the Terms of Service') }}</label>
                </div>

                <div class="pt-4">
                    <x-button type="submit">
                        {{ __('Continue') }}
                    </x-button>
                </div>
            </form>
        </x-block>
    </div>
</x-guest-layout>
