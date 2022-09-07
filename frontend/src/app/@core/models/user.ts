export interface User {
  email: string;
  name: string;
  password: string;
}

export interface UserResponse {
  ok: boolean;
  message?: string;
  user?: User;
  access_token?: string;
}
