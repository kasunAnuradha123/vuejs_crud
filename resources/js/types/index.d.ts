import { Config } from 'ziggy-js';

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    created_at_human: string;
    mark:number;
}

export interface AuthRequest {
    id: number;
    user_id: string;
    approval: number;
    approval_secret: string;
    time: string;
    remark: string;
    browser: string;
    is_confirm: number;
    user:User;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
