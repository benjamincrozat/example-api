# Example API

This repo is an assignment for a job interview.

## Check and tidy your work with these commands

- **Format**: `php vendor/bin/pint --parallel`
- **Test**: `php vendor/bin/pest --parallel` (you can use `--filter` to run specific tests)

## Development workflow

- `composer setup`
- `composer dev`
  - This runs multiple processes concurrently.
- Assume the project is always accessible locally at `https://example-api.test`. Never use `php artisan serve` unless `https://example-api.test` is not accessible.
- Commit every change you make to the codebase. Be as granular as possible.
- When you have to commit, start the message with a short summary (10 words, tops). Then, add a detailed description of the changes (use lists to make it easier to read).
- **Don't push code unless you have my approval.**

## Guardrails to keep in mind

- **Do not overwrite user edits between reads.** If something changed since your last read, understand why and build on it. Or at least, ask the user for clarification.
- **Never restore code that was deleted.** Like said above, if something was deleted, it was for a reason. Ask the user for clarification if necessary.
- **Keep changes small.** Implement the smallest change that solves the problem.
- **No scope drift.** Do not refactor, restyle, or add “nice-to-haves” unless explicitly requested.
- **Fix root causes.** Don’t band-aid symptoms.
- **Use web search when needed.** If version-specific behavior, third-party APIs, or unclear edge cases could change the implementation, verify in official docs/release notes and cite the source in your summary.
- **State assumptions when needed.** If a requirement is underspecified, proceed with clearly labeled assumptions; only ask questions when blocked.
- **Be concise and structured.** Prefer short, skimmable answers and concrete next actions over long explanations.
- **Narrate tool usage briefly.** Before multi-step work or tool calls, give a 1–2 sentence “what I’m doing and why” update.
- When executing a plan or a todo list, continue until it's complete. Don't ask for permission between tasks.
