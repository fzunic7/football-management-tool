import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, usePage } from "@inertiajs/react";
import NavLink from "@/Components/NavLink";
import PrimaryButton from "@/Components/PrimaryButton";
import SecondaryButton from "@/Components/SecondaryButton";
import { useForm } from "@inertiajs/react";
import { useEffect } from "react";

export default function Index({ auth, players, message }) {
    const { flash } = usePage().props;

    const { delete: destroy, processing } = useForm();

    const deleteTeam = (id) => {
        destroy(route("players.destroy", { id: id }));
    };
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Players
                </h2>
            }
        >
            <Head title="Teams" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    {flash.success && (
                        <div
                            className="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert"
                        >
                            <span className="font-medium">{flash.success}</span>
                        </div>
                    )}
                    <NavLink
                        href={route("players.create")}
                        active={route().current("players.create")}
                    >
                        <PrimaryButton>Create</PrimaryButton>
                    </NavLink>

                    <div className="relative overflow-x-auto">
                        <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" className="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Team
                                    </th>
                                    <th scope="col" className="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {players.map((player) => (
                                    <tr
                                        key={player.id}
                                        className="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    >
                                        <th
                                            scope="row"
                                            className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {player.name}
                                        </th>
                                        <td className="px-6 py-4">
                                          {player.team?.name || 'N/a'}
                                        </td>
                                        <td className="px-6 py-4">
                                            <Link
                                                href={route("players.show", {
                                                    id: player.id,
                                                })}
                                            >
                                                <SecondaryButton className="mr-1 mb-1 text-sky-400">
                                                    View
                                                </SecondaryButton>
                                            </Link>
                                            <Link
                                                href={route("players.edit", {
                                                    id: player.id,
                                                })}
                                            >
                                                <SecondaryButton className="mr-1 mb-1 text-green-400">
                                                    Edit
                                                </SecondaryButton>
                                            </Link>

                                            <SecondaryButton
                                                className="mr-1 mb-1 text-red-400"
                                                disabled={processing}
                                                onClick={() =>
                                                    deleteTeam(player.id)
                                                }
                                            >
                                                Delete
                                            </SecondaryButton>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}