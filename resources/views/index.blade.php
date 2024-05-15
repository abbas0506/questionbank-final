@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')
<style>
    .hero-image {
        background: url("{{asset('/images/bg/assessment.jpg')}}") no-repeat center center/cover;
        content: "";
        position: relative;
        width: 100%;
        height: 100%;
        scale: 75%;
        z-index: 1;
        opacity: 1;
        border-radius: 50%;
    }

    .tool-image::before {
        background: #edf3fb;
        content: "";
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 40px;
        transform: rotate(25deg);
        z-index: -1;
        /* opacity: 0.3; */
    }
</style>

<section id='hero' class="flex flex-col-reverse md:flex-row w-screen h-screen overflow-x-clip">
    <div class="flex flex-col justify-start md:justify-center flex-1 px-5 md:pl-24 mt-8 md:mt-24">
        <p class="text-teal-800 text-3xl md:text-5xl">Question Bank </p>
        <p class="text-slate-600 mt-3 text-md">50,000+ questions including short, long, MCQs have been taken from the exercises of textbooks and past papers, fully covering 9th to 12th classes.</p>
        <a href="{{url('login')}}" class="mt-5">
            <button class="btn-green">Get Started <i class="bi-arrow-right"></i></button>
        </a>
    </div>

    <div class="relative flex flex-col md:flex-row justify-center items-center flex-1">
        <div class="hero-image mt-16 md:mt-0">
        </div>
        <div class="absolute bottom-0 -z-10 border-slate-100 border-[200px] scale-[250%] rounded-full -skew-x-[20deg] transform">
        </div>

    </div>
</section>

<!-- features section -->
<section id='features' class="mt-12 px-4 md:px-24" data-aos="fade-up" data-aos-duration="1000">
    <h2 class="text-3xl text-center">It is for you!</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
        <div class="feature-box hover:border-pink-300 hover:bg-pink-50" data-aos="fade-up" data-aos-duration="1000">
            <div class="flex items-center justify-center bg-pink-100 rounded-full w-16 h-16">
                <i class="bi-book text-2xl text-pink-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Students</h3>
            <p class="text-sm text-center">Our online self-assessment service helps you prepare for your exams in a very short time.</p>
        </div>

        <div class="feature-box hover:border-orange-300 hover:bg-orange-50" data-aos="fade-up" data-aos-duration="1000">
            <div class="flex items-center justify-center bg-orange-100 rounded-full w-16 h-16">
                <i class="bi-laptop text-2xl text-orange-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Teachers</h3>
            <p class="text-sm text-center">Our custom paper generation service saves your time, effort and printing cost.</p>
        </div>

        <div class="feature-box hover:border-cyan-200 hover:bg-cyan-50" data-aos="fade-up" data-aos-duration="1000">
            <div class="flex items-center justify-center bg-cyan-100 rounded-full w-16 h-16">
                <i class="bi bi-palette text-2xl text-cyan-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Institutions</h3>
            <p class="text-sm text-center">Our class analytics service can make your institution distinguished among others </p>
        </div>
    </div>
</section>

<!-- distinction -->
<section class="mt-24 ">
    <div class="md:px-24">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            <div class="flex flex-col border border-green-200 bg-green-50" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-in-sine">
                <!-- videos showing the paper generation -->
                <div class="h-60 overflow-clip">
                    <img src="{{url('images/small/quiz.jpg')}}" alt="" class="tool-image w-full h-full skew-x-12 -transform -rotate-12 translate-x-6 -translate-y-12 scale-125">
                </div>
                <div class="p-5">
                    <h2 class="text-center">Self Assessment</h2>
                    <div class="h-1 w-24 bg-teal-800 mx-auto my-6"></div>
                    <ul class="list-disc list-inside leading-relaxed">
                        <li>100% free</li>
                        <li>No signup required</li>
                        <li>Online assessment</li>
                        <li>Time limt option</li>
                        <li>Fully automated</li>
                        <li>Multi-chapter selection</li>
                        <li>Instant result on screen </li>
                    </ul>

                </div>
            </div>
            <div class="flex flex-col bg-orange-50 border border-orange-200" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-in-sine">
                <!-- videos showing the paper generation -->
                <div class="h-60 overflow-clip">
                    <img src="{{url('images/small/paper-gen.jpg')}}" alt="" class="tool-image w-full h-full skew-x-12 -transform -rotate-12 translate-x-6 scale-125 -translate-y-12">
                </div>
                <div class="p-5">
                    <h2 class="text-center">Paper Generation</h2>
                    <div class="h-1 w-24 bg-teal-800 mx-auto my-6"></div>
                    <ul class="list-disc list-inside leading-relaxed">
                        <li>Fully automized</li>
                        <li>Quite simple and easy</li>
                        <li>Fully customized</li>
                        <li>PDF format</li>
                        <li>Font specification, page setting</li>
                        <li>Multiple papers per sheet</li>
                        <li>Link sharing on whatsapp</li>
                    </ul>

                </div>
            </div>

            <div class="flex flex-col bg-blue-50 border border-blue-200" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="ease-in-sine">
                <!-- videos showing the paper generation -->
                <div class="h-60 overflow-clip">
                    <img src="{{url('images/small/paper-gen.jpg')}}" alt="" class="tool-image w-full h-full skew-x-12 -transform -rotate-12 translate-x-6 scale-125 -translate-y-12">
                </div>
                <div class="p-5">
                    <h2 class="text-center">Reporting & Analytics</h2>
                    <div class="h-1 w-24 bg-teal-800 mx-auto my-6"></div>
                    <ul class="list-disc list-inside leading-relaxed">
                        <li>Course management</li>
                        <li>Time table</li>
                        <li>Exam datesheet</li>
                        <li>Class analystics </li>
                        <li>Annual registration</li>
                        <li>Unlimited Papers</li>
                        <li>Upto 50 teachers accounts</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- testimonial section -->
<section class="testimonials pt-0" data-aos="fade-up" data-aos-duration="1000">
    <div class="mt-24 px-4 md:px-16 md:w-3/4 mx-auto">
        <h2 class="text-3xl text-center">Our Team</h2>
        <p class="text-gray-600 text-center mt-8">
            Our software development team comprises of highly skilled and dedicated professionals who are 24/7 ready to support our clients. We are also in collaboration with supject experts in order to ensure the quality of question bank.
        </p>
        <div class="h-1 w-24 bg-teal-800 mx-auto mt-6"></div>
    </div>
    <div class="testimonials-carousel swiper w-full md:w-3/4 mx-auto mt-12">
        <div class="swiper-wrapper">
            <div class="testimonial-item swiper-slide">
                <img src="{{asset('images/small/development.jpg')}}" class="testimonial-img" alt="">
                <h3>Developers</h3>
                <h4>Web & Android</h4>
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    "We provide both web as well as android solution to our valuable clients. Our teams is contnuously working on this app to make it user-friendly as much as possible and keep it up to date with the upcoming demands."
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
            </div>

            <div class="testimonial-item swiper-slide">
                <img src="{{asset('images/small/collaboration.jpg')}}" class="testimonial-img" alt="">
                <h3>Collaborators</h3>
                <h4>Public & Private Sector</h4>
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    We have great collaboration with subject experts from public as well as private sector. It is due to their collobation that have succeeded to build an authentic question bank
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
            </div>
            <div class="testimonial-item swiper-slide">
                <img src="{{asset('images/small/clients.jpg')}}" class="testimonial-img" alt="">
                <h3>Clients</h3>
                <h4>Pubic & Private Sector</h4>
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    "Our satisfied clients are actually the real players of our team whose positive feedback helps us identifying our deficiencies and improve the user interface and experience"
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
            </div>

        </div>
        <div class="swiper-pagination"></div>
    </div>

</section><!-- End Ttstimonials Section -->

<section>
    <div class="relative overflow-x-clip md:px-24">
        <div class="flex items-center justify-center h-40 gap-x-8">
            <h1 class="text-teal-400 text-6xl" data-aos="zoom-in" data-aos-duration="1000"><i class="bi bi-telephone"></i></h1>
            <div data-aos="zoom-in" data-aos-duration="1000" class="text-md font-semibold tracking-wider">
                <p>+923004103160</p>
                <p>+923000373004</p>
            </div>
            <div class="absolute h-80 w-80 scale-150 -z-10 rounded-full bg-teal-50"></div>
        </div>

    </div>
</section>

<a href="{{url('https://wa.me/+923000373004')}}" class="flex justify-center items-center text-teal-600 text-5xl fixed right-8 bottom-8"><i class="bi-whatsapp"></i></a>
@endsection
@section('footer')
<!-- footer -->
<x-footer></x-footer>
@endsection