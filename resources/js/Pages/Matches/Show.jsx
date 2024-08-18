import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function Show({ auth, match }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    View Match
                </h2>
            }
        >
            <Head title="View Match" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <p className="text-lg font-semibold mb-4">
                                Match Date:
                            </p>
                            <p className="text-xl mb-6">
                                {new Date(
                                    match.match_date
                                ).toLocaleDateString()}
                            </p>

                            <p className="text-lg font-semibold mb-4">Teams:</p>
                            <p className="text-xl mb-6">
                                {match.team1.name} vs {match.team2.name}
                            </p>

                            <p className="text-lg font-semibold mb-4">
                                Result:
                            </p>
                            <p className="text-xl mb-6">
                                {match.result.team_1_score}:{match.result.team_2_score}
                            </p>

                            <Link
                                href={route("matches.index")}
                                className="text-blue-500 hover:text-blue-700"
                            >
                                Back to Matches
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
