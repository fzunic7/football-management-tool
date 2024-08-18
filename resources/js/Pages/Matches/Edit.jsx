import React, { useEffect } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Transition } from "@headlessui/react";
import SecondaryButton from "@/Components/SecondaryButton";
import SelectInput from "@/Components/SelectInput";

export default function Edit({ auth, match, teams }) {
    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            team_1_id: match.team_1_id,
            team_2_id: match.team_2_id,
            match_date: match.match_date,
            team_1_score: match.result ? match.result.team_1_score : "",
            team_2_score: match.result ? match.result.team_2_score : "",
        });

    const team1Options = teams.map((team) => ({
        value: team.id,
        label: team.name,
    }));

    const team2Options = team1Options.filter(
        (team) => team.value !== data.team_1_id
    );

    const submit = (e) => {
        e.preventDefault();
        patch(route("matches.update", { match: match.id }));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Match
                </h2>
            }
        >
            <Head title="Edit Match" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <form onSubmit={submit} className="mt-6 space-y-6">
                        <div>
                            <InputLabel htmlFor="team_1_id" value="Team 1" />

                            <SelectInput
                                id="team_1_id"
                                className="mt-1 block w-full"
                                value={data.team_1_id}
                                onChange={(e) =>
                                    setData("team_1_id", e.target.value)
                                }
                                options={team1Options}
                                required
                            />

                            <InputError
                                className="mt-2"
                                message={errors.team_1_id}
                            />
                        </div>

                        <div>
                            <InputLabel htmlFor="team_2_id" value="Team 2" />

                            <SelectInput
                                id="team_2_id"
                                className="mt-1 block w-full"
                                value={data.team_2_id}
                                onChange={(e) =>
                                    setData("team_2_id", e.target.value)
                                }
                                options={team2Options}
                                required
                            />

                            <InputError
                                className="mt-2"
                                message={errors.team_2_id}
                            />
                        </div>

                        <div>
                            <InputLabel
                                htmlFor="match_date"
                                value="Match Date"
                            />

                            <TextInput
                                id="match_date"
                                type="date"
                                className="mt-1 block w-full"
                                value={data.match_date}
                                onChange={(e) =>
                                    setData("match_date", e.target.value)
                                }
                                required
                            />

                            <InputError
                                className="mt-2"
                                message={errors.match_date}
                            />
                        </div>

                        <div>
                            <InputLabel
                                htmlFor="team_1_score"
                                value="Team 1 Score"
                            />

                            <TextInput
                                id="team_1_score"
                                type="number"
                                className="mt-1 block w-full"
                                value={data.team_1_score}
                                onChange={(e) =>
                                    setData("team_1_score", e.target.value)
                                }
                                required
                            />

                            <InputError
                                className="mt-2"
                                message={errors.team_1_score}
                            />
                        </div>

                        <div>
                            <InputLabel
                                htmlFor="team_2_score"
                                value="Team 2 Score"
                            />

                            <TextInput
                                id="team_2_score"
                                type="number"
                                className="mt-1 block w-full"
                                value={data.team_2_score}
                                onChange={(e) =>
                                    setData("team_2_score", e.target.value)
                                }
                                required
                            />

                            <InputError
                                className="mt-2"
                                message={errors.team_2_score}
                            />
                        </div>

                        <div className="flex items-center gap-4">
                            <Link href={route("matches.index")}>
                                <SecondaryButton disabled={processing}>
                                    Cancel
                                </SecondaryButton>
                            </Link>
                            <PrimaryButton disabled={processing}>
                                Save
                            </PrimaryButton>
                            <Transition
                                show={recentlySuccessful}
                                enter="transition ease-in-out"
                                enterFrom="opacity-0"
                                leave="transition ease-in-out"
                                leaveTo="opacity-0"
                            >
                                <p className="text-sm text-gray-600">Saved.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
