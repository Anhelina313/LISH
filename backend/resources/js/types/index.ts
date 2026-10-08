import type { LucideIcon } from 'lucide-vue-next';

export type RoleName = 'student' | 'teacher' | 'admin';

export type UserStatusName = 'registered' | 'active' | 'inactive';

export interface Role {
    id: number;
    name: RoleName;
}

export interface UserStatus {
    id: number;
    name: UserStatusName;
}

export interface User {
    id: number;

    role_id: number;
    status_id: number;

    name: string;
    email: string;

    profile_photo_path: string | null;
    email_verified_at: string | null;

    created_at: string;
    updated_at: string;

    role?: Role;
    status?: UserStatus;
}

export interface LessonPreview {
    subject: string;
    date: string;
    time: string;

    teacher?: string;
    student?: string;

    calendar_url?: string | null;
    meeting_url?: string | null;
}

export interface HomeworkPreview {
    title: string;
    deadline: string;
    status?: string;

    classroom_url?: string | null;
}

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData {
    name: string;

    quote: {
        message: string;
        author: string;
    };

    auth: Auth;

    ziggy: {
        location: string;
        url: string;
        port: null | number;
        defaults: Record<string, unknown>;
        routes: Record<string, string>;
    };
}

export type BreadcrumbItemType = BreadcrumbItem;
