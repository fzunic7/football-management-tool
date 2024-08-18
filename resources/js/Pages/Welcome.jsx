import { Link, Head } from "@inertiajs/react";

export default function Welcome({ auth, appVersion }) {
    return (
        <>
            <Head title="Welcome to Football Manager" />
            <div className="bg-green-900 text-white min-h-screen flex flex-col items-center justify-center">
                {/* Background Image */}
                <img
                    id="background"
                    className="absolute inset-0 object-cover w-full h-full opacity-30"
                    src="/images/football-field.jpg"
                    alt="Football field background"
                />

                {/* Logo Section */}
                <div className="relative z-10 w-full max-w-3xl text-center py-10">
                    <img
                        src="/images/logo.png"
                        alt="Football Management Logo"
                        className="mx-auto w-20 h-20"
                    />
                    <h1 className="text-4xl font-bold mt-4">
                        Football Management Tool
                    </h1>
                    <p className="mt-2 text-lg">Manage your team like a pro</p>
                </div>

                {/* Navigation Section */}
                <div className="relative z-10 w-full max-w-3xl grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <a
                        href={auth.user ? route("dashboard") : route("login")}
                        className="flex items-center justify-center bg-white text-green-900 py-4 rounded-lg shadow-lg transition hover:bg-gray-200"
                    >
                        {auth.user ? "Go to Dashboard" : "Log in"}
                    </a>
                    {!auth.user && (
                        <a
                            href={route("register")}
                            className="flex items-center justify-center bg-white text-green-900 py-4 rounded-lg shadow-lg transition hover:bg-gray-200"
                        >
                            Register
                        </a>
                    )}
                </div>

                {/* Features Section */}
                <div className="relative z-10 w-full max-w-5xl mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 px-6">
                    <div className="bg-white text-green-900 p-6 rounded-lg shadow-lg transition hover:shadow-xl">
                        <h2 className="text-xl font-semibold">
                            Player Management
                        </h2>
                        <p className="mt-4">
                            Organize and track your players' stats, performance,
                            and development.
                        </p>
                    </div>
                    <div className="bg-white text-green-900 p-6 rounded-lg shadow-lg transition hover:shadow-xl">
                        <h2 className="text-xl font-semibold">
                            Team Strategies
                        </h2>
                        <p className="mt-4">
                            Plan and execute game strategies with detailed
                            tactics and formations.
                        </p>
                    </div>
                    <div className="bg-white text-green-900 p-6 rounded-lg shadow-lg transition hover:shadow-xl">
                        <h2 className="text-xl font-semibold">
                            Match Analytics
                        </h2>
                        <p className="mt-4">
                            Analyze match data and make informed decisions to
                            lead your team to victory.
                        </p>
                    </div>
                </div>

                {/* Footer Section */}
                <footer className="relative z-10 w-full max-w-3xl text-center mt-16">
                    <p className="text-sm">
                        &copy; {new Date().getFullYear()} Football Management
                        Tool - Version {appVersion}
                    </p>
                </footer>
            </div>
        </>
    );
}
