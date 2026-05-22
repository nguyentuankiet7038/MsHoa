@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

<main>
    <!-- Hero Section -->
    <section class="relative w-full min-h-[819px] flex items-center px-6 md:px-12 py-20 overflow-hidden bg-surface-container-low">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover opacity-20" data-alt="A bright and spacious modern English language learning classroom with large windows letting in natural sunlight. Several diverse young adult students are engaged in an enthusiastic group discussion, smiling and holding notebooks. The aesthetic is professional yet warm, using a clean light-mode palette with subtle purple and turquoise accents to match a prestigious educational center's brand identity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCSAIYERgnq4roATMF2addyD8rJwzpmQeXs2mBeXdR-Dh4-kt5rLFDgt0HJ3eSPkIS-4PpnIVs3XQaZwrsTL33aX4BQuP4wfaRNHjxanF8dYLeWTdcQY2UfG9y67378YaB-3VUWxVOKvd-tkC8FzLZGJp36vTPMU10bi17CsWmNxIBjO4Yzp6DCfYIm40whgRq29JzsUdX43aNLv35Mw1TN-CDesNUSS4FS0XPR0D1UfcB6j69Cw7hzd1gGvgxFiOjz6JsUnUAXzNA" />
        </div>
        <div class="relative z-10 max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-black text-on-surface mb-6 leading-tight">Master English.<br /><span class="text-primary">Master Your Destiny.</span></h1>
            <p class="text-xl text-on-surface-variant mb-10 max-w-xl">Join over 50,000 students who have transformed their careers with Ms. Hoa's expert IELTS and Communication programs.</p>
            <div class="flex flex-wrap gap-4">
                <button class="bg-accent-turquoise text-white px-8 py-4 rounded-full font-bold text-lg hover:brightness-110 transition-all shadow-lg flex items-center gap-2">
                    Get Started Today
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
                <button class="border-2 border-primary text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-primary hover:text-on-primary transition-all">
                    View Schedule
                </button>
            </div>
        </div>
    </section>
    <!-- Course Grid (Bento Style) -->
    <section class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-black text-on-surface">Prominent Courses</h2>
                <p class="text-on-surface-variant">Start your journey with our world-class curriculum.</p>
            </div>
            <button class="text-primary font-bold flex items-center gap-1 hover:underline">
                View all courses
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <!-- Course 1: Featured Large -->
            <div class="md:col-span-8 bg-white rounded-[2rem] overflow-hidden shadow-xl border border-outline-variant flex flex-col md:flex-row group">
                <div class="md:w-1/2 relative h-64 md:h-full">
                    <img class="w-full h-full object-cover" data-alt="A close-up shot of an open English textbook and a high-quality fountain pen on a clean white desk, surrounded by organized study notes. The lighting is crisp and bright, creating a focused academic atmosphere. The composition uses high-end product photography techniques to convey the premium quality of the IELTS intensive training program." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBepGa4cLhZuI0j5vK3ziazmuySXLP3X8_m1bkJZL962OWMR9XiZfzy50cXkrNEmlG4qtcDS7Kg--bD-VBlETgyXuXVa-AwpDU1PaTGfN4y9YiFDeyX8BlAR7ackrTG4nImo9pxuL63s-2VRzOqLcwbFb0H5asf0GaWl43oGacxNwUKlsL3Hltxdxa2ozOuRl3XKZrrplfz1NdfxTD7PWtUtHDEkw0nGsEVgMIEYK1HifZ5FU_CEGk7_MH-hDlpQeRqtE50ZoWBV2k" />
                    <span class="absolute top-4 left-4 tag-hot px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">Hot</span>
                </div>
                <div class="md:w-1/2 p-8 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-primary-fixed text-on-primary-fixed px-3 py-1 rounded-full text-xs font-bold">Certification</span>
                            <span class="text-outline text-xs flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> 12 Weeks</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 group-hover:text-primary transition-colors">IELTS Intensive Mastery (7.5+)</h3>
                        <p class="text-on-surface-variant text-sm mb-6">Master all four skills with our proprietary feedback loop system and certified examiners.</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-black text-on-surface">$599</span>
                        <button class="bg-accent-turquoise text-white px-6 py-3 rounded-full font-bold hover:brightness-110 transition-all">Enroll Now</button>
                    </div>
                </div>
            </div>
            <!-- Course 2: Standard -->
            <div class="md:col-span-4 bg-white rounded-[2rem] overflow-hidden shadow-md border border-outline-variant flex flex-col hover:shadow-lg transition-shadow group">
                <div class="h-48 relative">
                    <img class="w-full h-full object-cover" data-alt="A small, vibrant group of international professionals sitting in a collaborative modern workspace, engaging in business English communication. They are laughing and talking naturally, emphasizing a friendly and effective learning environment. Soft, warm sunlight filters through the office, highlighting a clean and energetic aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEur2xkHemy_kBHROX3Qdqg_VTon4BLVmsSDso9WV9-a6pf-JMraXc8xBTlx_KNLgJwDW5v1SJd3LIf8ZxIZexmiR3IWcBkiP6Kg1Gntlhc92Ct37HrSkp8xgBXTvib1I4q4Z6szYt5tptqF19NiQ2itduYWaTulH8PKGu1_AeyUR-EgRA_T4E67LUAtjg2CthRJZjWJFA-WYcOQmNxvvjAxSADQ7mSX0SaiyQhMPGyn-7gs6kXfjoIu4fKwmYUvYSmgA8pXi3n1Q" />
                    <span class="absolute top-4 left-4 bg-green-600 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">New</span>
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors">Business Communication Pro</h3>
                        <p class="text-on-surface-variant text-sm mb-4">Elevate your workplace presence with professional presentation and negotiation skills.</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-black text-on-surface">$349</span>
                        <button class="bg-accent-turquoise text-white p-3 rounded-full hover:brightness-110 transition-all">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Course 3: Standard -->
            <div class="md:col-span-4 bg-white rounded-[2rem] overflow-hidden shadow-md border border-outline-variant flex flex-col hover:shadow-lg transition-shadow group">
                <div class="h-48">
                    <img class="w-full h-full object-cover" data-alt="A youthful and energetic photo of two students high-fiving in a library setting, holding their English certificates. The image captures the joy of achievement and personal growth. The color palette is bright and optimistic, with a focus on natural skin tones and a clean, modern educational background." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB1yfzUNgo6yXhPxHYuuVjjibAGAQ6Za5-Amps1NZqKfVX1vHW9H7B7-Cqy0M-kw3slvZQCpm5tVANqs892qqSg31pxGZqkxwPKAXkQQThjcR_Ibt4PATJFNUToVDkX2g_8d_6pODgLmBSt0jY-8DAZcXk6CsMkyYCuOw6ZA5IKlh8wvMgfTHChgsLoLWmMsKkwk_7KqCyCvPq523bleRQGP8uK3ZVl1xW17588D8Svvd_jOHXhhYghRGMjv77BURBEsQLeUV1NkY0" />
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors">Foundation English (A1-B1)</h3>
                        <p class="text-on-surface-variant text-sm mb-4">The perfect starting point for beginners to build a solid grammar and vocabulary base.</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-black text-on-surface">$199</span>
                        <button class="bg-accent-turquoise text-white p-3 rounded-full hover:brightness-110 transition-all">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Course 4: Standard -->
            <div class="md:col-span-4 bg-white rounded-[2rem] overflow-hidden shadow-md border border-outline-variant flex flex-col hover:shadow-lg transition-shadow group">
                <div class="h-48">
                    <img class="w-full h-full object-cover" data-alt="An overhead shot of a laptop, a notebook with clear handwriting, and a cup of coffee on a wooden desk, symbolizing the flexibility of online learning. The screen displays a video call with a friendly English teacher. The lighting is soft and natural, evoking a cozy and productive home-study atmosphere." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCrVeyj0VtrXMnJ_1km-6DIVeL_vwbcSuy1YjD8xDg6xgBtXHCih39pyKbLOEwKeIRQCdkxZ5xWEGgeko99m8PMQW-6w9U-yu73W8K8Aqq34tmoX7S0rfGYAouejt9NzxKkMYA0LjFpg9XSMEsxvTjDC1bBCG2sxMubeQKosNVOppuD7BdBpnZNfHm77XBVeFFxa9bq4y6nKB3r4rcB2k8xB8GabPsvbyC53rYfrZMJwoKJdPOdB6x7thqUeYDmQLbrVa2YpJ6nxcE" />
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2 group-hover:text-primary transition-colors">TOEIC Masterclass</h3>
                        <p class="text-on-surface-variant text-sm mb-4">Focused strategies to ace the TOEIC test for career advancement in global companies.</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xl font-black text-on-surface">$299</span>
                        <button class="bg-accent-turquoise text-white p-3 rounded-full hover:brightness-110 transition-all">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- CTA Banner -->
            <div class="md:col-span-4 bg-primary rounded-[2rem] p-8 text-on-primary flex flex-col justify-center items-center text-center">
                <span class="material-symbols-outlined text-5xl mb-4" style="font-variation-settings: 'FILL' 1;">stars</span>
                <h3 class="text-2xl font-black mb-2">Not sure where to start?</h3>
                <p class="mb-6 opacity-80">Take our free 15-minute placement test and get a personalized learning path.</p>
                <button class="bg-white text-primary px-8 py-3 rounded-full font-bold hover:bg-surface-container-high transition-all">Test Your Level</button>
            </div>
        </div>
    </section>
    <!-- Testimonials -->
    <section class="bg-surface-container-highest py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-on-surface mb-4">Success Stories</h2>
                <p class="text-on-surface-variant max-w-2xl mx-auto">Hear from our students who achieved their dreams through our English programs.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-surface p-8 rounded-[2rem] shadow-sm flex flex-col">
                    <div class="flex text-primary mb-6">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="text-on-surface italic mb-8 flex-grow">"The IELTS intensive course was a game-changer for me. I went from a 6.0 to a 7.5 in just 3 months. Ms. Hoa's method of breaking down complex grammar is unmatched."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary-fixed overflow-hidden">
                            <img class="w-full h-full object-cover" data-alt="A professional portrait of a young Vietnamese woman with a confident smile, wearing business casual attire. She is positioned against a soft-focus office background. The lighting is warm and flattering, conveying a sense of success and professionalism achieved through learning." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8QXSjdkS5S9Jp8N8zOBKYYcFD42gjTAuoRjjAlUAAUqR53KRHQ74_xyXwzWRt0TfL8ouLeOaItA9bswI929xCQLrN2CPQzCaQxUNf7ngqXmSIzy1i9N5Q347l1olJTEgLAO7pVA0rbqsIRG2n6JAeM4mCnra6EwgCz98csrnyTnX6mcdfVrfYSO9KNHcy-GL30pUrTIbs7iZMvg7dbRXGxE82LJ5KPslZ_x5c0pBlwa7LFubBJhpmEeuDAEWVdjPaVZQ2ubqpzYw" />
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">Minh Anh Tran</h4>
                            <p class="text-xs text-on-surface-variant">Overseas Student, Melbourne</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-surface p-8 rounded-[2rem] shadow-sm flex flex-col">
                    <div class="flex text-primary mb-6">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="text-on-surface italic mb-8 flex-grow">"I used to be terrified of speaking in meetings. After the Business English course, I now lead presentations with confidence. My colleagues were amazed by the transformation!"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary-fixed overflow-hidden">
                            <img class="w-full h-full object-cover" data-alt="A headshot of a smiling young male professional in a crisp white shirt, radiating confidence and friendliness. The background is a modern architectural space with clean lines. The photography style is high-key and bright, representing the successful outcome of language proficiency." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCr3ufZiv3_4GJ68QkJWacCi-kBfix6jrjaC-JfTFqVsgkJVfQzthhE9LlvDl3vHaeSDJDpn3INfOuiwVu_Mb55hhyJ_lUcCMbY41MZ2u51oUaaZtOA6NKy6fa_cYzXM7LCnZxVygMSBxwuBoyvxW_3WKI2mIao-99qXvkMgidyim8yE9LwGaDJK5_MsLU9NwZvazsRqG1pGnT5haAQwLAPKgo_IMYsCSyuhO3XwXtqGYFNo9fjQZNqtc__7L-EwDC0z3MT0sztF2g" />
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">Hoang Nguyen</h4>
                            <p class="text-xs text-on-surface-variant">Marketing Manager, Tech Corp</p>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-surface p-8 rounded-[2rem] shadow-sm flex flex-col">
                    <div class="flex text-primary mb-6">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="text-on-surface italic mb-8 flex-grow">"The community at Ms. Hoa English is what makes it special. I've made lifelong friends while improving my English. Highly recommend for anyone looking for a supportive environment."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary-fixed overflow-hidden">
                            <img class="w-full h-full object-cover" data-alt="A professional and friendly portrait of a woman in her late 20s, looking directly at the camera with an encouraging expression. She is in a collaborative library space. The aesthetic is clean and academic, emphasizing the intellectual and social benefits of the learning program." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAWpHeCxxDCzM7it-1NS8AXTcbb7AI5luOwF1BeK_bkyAZlmafzqw0kbmGQjta_WKksj_f_SfbfLqz7y2Gzb5UbNqLis-iZaecTXtkYaCbN3H1b36ibHJJM7jB3nw_xbSYqWvPIGFvKDcQixrr5jqF-iKyxbex_wXVnwpzGPGcbiq4oQNZarywPMWKOmEelP1pyoO-TjVc2kqZfo2bBSZWmyT6o_RgowitP4LUOzO4Yql3oysvbyIA_bRE6LODXxdFfr5gYDMRXXBA" />
                        </div>
                        <div>
                            <h4 class="font-bold text-on-surface">Lan Phuong</h4>
                            <p class="text-xs text-on-surface-variant">Content Creator</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest News -->
    <section class="py-24 px-6 md:px-12 max-w-7xl mx-auto">
        <h2 class="text-3xl font-black text-on-surface mb-12">Latest News</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A vibrant scholarship event poster design style image featuring excited students celebrating in a modern auditorium. Colorful confetti is falling, and a large digital screen in the background displays 'Congratulations' in elegant typography. The atmosphere is festive and high-energy." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1tYvhdz3m5DfQAh_U0fA-QHkWgzBkMDvZIXP6y4NufD1GmPrghjciCPJI2XoQDk9VWXgL-gg_kXeXpCW1IcxIfMKilwlavolquAfiB7GN34j609AR66xRWHVahs-XnliZriPwSRJ3Hei_5dTF8-gWdUJYR5cOCq1drV_n4HGVRxul9x3Zlf6xSbaDFTKiVSzPQ5wZvbNRbRlGxbaamqq8NRAqfWtVQ2jVTtl7eZ6PazcS7eHB7GK9dR6CJTk4u5LOIfKN3hztXlQ" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Events</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">Announcing the 2024 Global Excellence Scholarship</h4>
                <p class="text-sm text-on-surface-variant mt-2">March 15, 2024</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A clean, minimalist workspace featuring a tablet showing an educational app, a notebook, and a pair of modern headphones. The lighting is soft and focused, creating a studious and technological mood. The composition is uncluttered and sophisticated." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDAMr91lx6K332Ev8Nj5Ur8Uuo14fkD9kY0Q674gnlp3aCKoJ5tayNp390j9rxqO8o9YXCnDgu8cmODzD8D0y_2PwdFPyWLIcCvXd_CjvQavq1dGGo9MijGD7gNwmpTkqkDciVMc83gTVni3YMvtsDPQuneiGbtwBEhWGiUx5Zl6DeZBg9BsGUiCQxcjja6rFz8I5AUSUnFkU6M__E_sMOp4QG0WI0Vg7T_a0xbGfL7Y8P9LoDchVSB7z_UPz-koZOCBh7m5daZx-M" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Tips &amp; Tricks</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">5 Secrets to Improving Your English Pronunciation</h4>
                <p class="text-sm text-on-surface-variant mt-2">March 12, 2024</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A teacher at the front of a classroom using an interactive whiteboard with colorful English vocabulary diagrams. The students are partially visible in the foreground, indicating an engaged learning environment. The image is bright and technologically forward." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC70BjGpoxJlEsMrWePGBE6FD3VFDycMOeIsmSvHoIVy1FGTlOXKFt9IEzKxyt70dhWw9Jatsup8KHanHCq-D7xCkOgUma1VK4C_qe50CHTNGpzWpoKzZmUv1lQ0BO-y8tD7_MXMDTaed5seGT9w0_rGW2E8CyPd1AnU8Oz6wGeiHEs7TtcPxuC0carWRsSl46zvfGJ42x5BbQ0196v1asqGWUh5CQW-jzXeyBQlPc4c4eQFmMyU8OqOoqJntcn1lo-yLHbsulBg00" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Academics</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">New 'Cambridge Primary' Curriculum Launched</h4>
                <p class="text-sm text-on-surface-variant mt-2">March 10, 2024</p>
            </div>
            <div class="group cursor-pointer">
                <div class="aspect-video rounded-2xl overflow-hidden mb-4 border border-outline-variant">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="A close-up of a high-end microphone and a laptop in a podcast studio setting. The lighting is dramatic and warm, with subtle purple and blue backlight. The image represents the launch of a new educational podcast series." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBauUVDdsUL6HTCCshViPmBKvGxYyiI0NmKkRyRKWy94lSoNK49bRAD3e-dUnU2DPclynCVGR8KKkL0reGHgAKD3M1BLlHLgSc-NnhaXZzZI9oZc11aCHOvFO7uSW9iH3JNKs66j3DcpepV3Jfd2dnODLqMbAZ5vxnmob1QLBS5mSKHS4ek--Pxhv90DFBDf07XXe4Y5YEtJd2Z6pkrO6LLhwMtDvwAwvC9Tfq2UPlvl_bgrAyVTGgmTbkkQWkd88cnf_4zSmpCCwY" />
                </div>
                <span class="text-primary text-xs font-bold uppercase mb-2 block">Media</span>
                <h4 class="text-lg font-bold text-on-surface leading-snug group-hover:text-primary transition-colors">Ms. Hoa Podcast: Episode 45 with IELTS Examiners</h4>
                <p class="text-sm text-on-surface-variant mt-2">March 08, 2024</p>
            </div>
        </div>
    </section>
</main>
@endsection