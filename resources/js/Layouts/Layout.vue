<template>
    <div id="main-wrapper">
        <div id="sidebar" class="min-w-[350px] bg-gradient-to-b from-gray-700 to-gray-500 flex flex-col items-center">
            <div id="branding">
                <img src="https://scontent.fmnl4-7.fna.fbcdn.net/v/t39.30808-6/435580898_806881104651453_6556597007403151769_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeER8ebPMUULcNw0B6_-5z2Y-hu0mfQrn2v6G7SZ9Cufa8uofabLumzuzxQTUd40HvRwbtoSKCH7VyHRY0O4SAwN&_nc_ohc=t0zNN-B__I8Q7kNvgFA0Qrj&_nc_ht=scontent.fmnl4-7.fna&oh=00_AYBNOSgbnRsd9mQwIBqLspCuTLxlkBdEaCc-vB_efg0_bQ&oe=665A0990" alt="Profile Picture">
            </div>

            <div>
                <h1 class="mt-[10%] font-bold">Francis Reserva<br> <em>(cis)</em></h1>
                <h4>BSIT 3</h4>
            </div>

            <div class="mt-[20%]">
                <Link href="/projects" class="button-53"> Achievements</Link>
                <Link href="/landing" class="button-about-me">About</Link>
            </div>
        </div>
        <div id="content" class="flex flex-col flex-1">
            <div class="flex-1 p-0">
                <Transition name="page-trans" mode="out-in">
                    <div>
                        <slot />
                    </div>
                </Transition>
            </div>
            <!-- <footer class="py-4 text-gray-600 text-center bg-white" style="font-style: italic;">
                Inertia Final Project 2024
            </footer> -->
        </div>
    </div>
</template>

<script setup>
    import { Link } from "@inertiajs/vue3";
</script>

<style scoped>
/* Sidebar styling */
#sidebar {
    min-width: 350px;
    background: linear-gradient(to bottom, #2d3748, #4a5568); /* Gradient from dark to lighter gray */
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

#branding img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin-top: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

h1 {
    margin-top: 20px;
    font-size: 28px;
    color: #fff;
    text-align: center;
}

h4 {
    margin-top: 10px;
    font-size: 20px;
    color: #a0aec0;
    text-align: center;
}

/* Button styling */
.button-53, .button-about-me {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    margin-bottom: 15px;
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    color: #fff;
    background-color: #3d52b1;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.button-53:hover, .button-about-me:hover {
    background-color: #2b3a91;
    transform: translateY(-2px);
}

.button-about-me {
    background-color: #0bdaad;
}

.button-about-me:hover {
    background-color: #098b84;
}

/* Main wrapper and content styling */
#main-wrapper {
    display: flex;
    min-height: 100vh;
    background-color: #f7fafc;
}

#content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

#content .flex-1 {
    flex: 1;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin: 20px;
}

#content footer {
    padding: 10px;
    text-align: center;
    color: #4a5568;
    background-color: #e2e8f0;
    border-radius: 0 0 8px 8px;
    box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
}

h1, h4 {
    font-family: 'Roboto', sans-serif;
}

.button-53, .button-about-me {
    font-family: 'Roboto', sans-serif;
}
</style>
